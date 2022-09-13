<?php

namespace App\Controllers;
use App\Models\IndikatorKinerjaModel;
use App\Models\UsersModel;
use CodeIgniter\Files\FileCollection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Kinerja2 extends BaseController
{
    private $session=null;
   
    //konstraktor
    public function __construct()
    {
        $this->IndikatorKinerjaModel= new IndikatorKinerjaModel();
        $this->UsersModel= new UsersModel();
        $this->session=session();
        $this->id_pengguna=$this->session->get('id_pengguna');
    }

    //tampilan kinerja
    public function index()
    {
        $this->session=session();
        $id=$this->session->get('id_pengguna');
        $data['id']=$id;
        $query = $this->IndikatorKinerjaModel->getIKK();
        $userQuery=$this->UsersModel->getUsers();
        $fotoQuery=$this->IndikatorKinerjaModel->getFoto();
        $docQuery=$this->IndikatorKinerjaModel->getDokumen();
        $data['user']=$userQuery->getResultArray();
        $data['coba']=$query->getResultArray();
        $data['foto']=$fotoQuery->getResultArray();
        $data['doc']=$docQuery->getResultArray();
        d($data);
        return view('pages/backup',$data);
    }
    public function downloadFormat(){
        return $this->response->download('../public/uploads/file/Format_Pengukuran_Kinerja_Triwulan_2022.xlsx', null);
    }

    public function ses(){
        $this->session=session();
        $data['get_sess']=$this->session->userdata('id_pengguna');
    }

    //function membaca excel
    public function readExcel()
    {
        $userQuery=$this->UsersModel->getUsers();
        $data=$userQuery->getRow();
        $id_pengguna= str_replace(' ','',$data->keterangan);
        //validation submit
        $input = $this->validate([
            'excel' => [
                'rules'=>'uploaded[excel]',
                'errors'=>[
                    'uploaded' => 'Pilih file excel terlebih dahulu!'
                ]
            ]
        ]);
        
        if (!$input) {
            return  redirect()->to(base_url('/backup'))->withInput();
        }

        $fileExcel = $this->request->getFile('excel');
        d($fileExcel);
        $ext = $fileExcel->getExtension();
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');
        d($ext);
       
        // looping untuk mengambil data
        $spreadsheet = IOFactory::load($fileExcel);
        $sheet =  $spreadsheet->getActiveSheet()->toArray(0, true, true, true);
        d($sheet);
        $i=1;
        $id=0;
        foreach ($sheet as $idx => $row) {
            //skip index sampai 5 tidak terpakai
            if ($idx <= 5) {
                continue;
            }
            if($id_pengguna!=str_replace(' ','',$row['M'])){
                if($id_pengguna!='Admin'){
                    $i++;
                    continue;
                }
            }
           
            //memasukkan data excel ke array $data
            $data=[
                'indikator'=>$row['C'],
                'target_pk' =>$row['D'],
                'target_tw' =>$row['E'],
                'capaian' => $row['F'],
                'presentase' => $row['G'] 
            ];
           
            //memasukkan $data ke database
            $this->IndikatorKinerjaModel->updateExcel($i,$data);
            if(!empty($row['H'])){
                $val1['progres']=$row['H'];
                $this->IndikatorKinerjaModel->updateProgresExcel($i,$val1);  
            }
            if(!empty($row['I'])){
                $val2['kendala']=$row['I'];
                $this->IndikatorKinerjaModel->updateKendalaExcel($i,$val2);  
            }
            if(!empty($row['J'])){
                $val3['strategi']=$row['J'];
                $this->IndikatorKinerjaModel->updateStrategiExcel($i,$val3);  
            }
            
            $i++;

        }
         d($data);
        return redirect()->to(base_url('/backup'));
    }
    public function readExcelCreate()
    {
        $userQuery=$this->UsersModel->getUsers();
        $data=$userQuery->getRow();
        $query = $this->IndikatorKinerjaModel->getIKK();
        $sistem=$query->getLastRow()->sistem;
        d($data);
        $id_pengguna= str_replace(' ','',$data->keterangan);
        //validation submit
        $input = $this->validate([
            'excel' => [
                'rules'=>'uploaded[excel]',
                'errors'=>[
                    'uploaded' => 'Pilih file excel terlebih dahulu!'
                ]
            ]
        ]);
        
        if (!$input) {
            return  redirect()->to(base_url('/backup'))->withInput();
        }

        $fileExcel = $this->request->getFile('excel');
        d($fileExcel);
        $ext = $fileExcel->getExtension();
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!');
        d($ext);
       
        // looping untuk mengambil data
        $spreadsheet = IOFactory::load($fileExcel);
        $sheet =  $spreadsheet->getActiveSheet()->toArray(0, true, true, true);
        d($sheet);
        $i=1;
        $id=0;
        foreach ($sheet as $idx => $row) {
            //skip index sampai 5 tidak terpakai
            if ($idx <= 5) {
                continue;
            }
            if($id_pengguna!=str_replace(' ','',$row['M'])){
                if($id_pengguna!='Admin'){
                    $i++;
                    continue;
                }
            }
            $dataIKU=[
                'id_iku'    => $i
            ];
            $queryIKU=$this->IndikatorKinerjaModel->getIKU($dataIKU);
            $iku=$queryIKU->getRow()->iku;

            $queryID=$this->IndikatorKinerjaModel->getID(str_replace(' ','',$row['M']));
            $dt_pgn=$queryID->getResultArray();
            foreach ($dt_pgn as $pgn => $value) {
                $id_pgn=$value['keterangan'];
            }
            d($id_pgn);
            // dd($iku);
            //memasukkan data excel ke array $data
            $data=[
                'indikator'=>$row['C'],
                'target_pk' =>$row['D'],
                'target_tw' =>$row['E'],
                'capaian' => $row['F'],
                'presentase' => $row['G'],
                'pic'      => $row['M'],
                 'tahun'    => 2022,
                 'sistem'   => $sistem+1,
                'iku'   =>str_replace(' ','',$id_pgn)
                //  'iku'      => 
            ];
           
            //memasukkan $data ke database
            $this->IndikatorKinerjaModel->createExcel($i,$data);
            // if(!empty($row['H'])){
            //     $val1['progres']=$row['H'];
            //     $this->IndikatorKinerjaModel->updateProgresExcel($i,$val1);  
            // }
            // if(!empty($row['I'])){
            //     $val2['kendala']=$row['I'];
            //     $this->IndikatorKinerjaModel->updateKendalaExcel($i,$val2);  
            // }
            // if(!empty($row['J'])){
            //     $val3['strategi']=$row['J'];
            //     $this->IndikatorKinerjaModel->updateStrategiExcel($i,$val3);  
            // }
            
            $i++;

        }
        d($data);
        return redirect()->to(base_url('/backup'));
    }

    //
    public function saveCapaian()
    {
        $data[]=$this->request->getPost();
        d($data);
        foreach($data as $dt => $value)
        {
            $index=$value['index'];
            $id=$value['id'.$index];
            $iku=$value['iku'.$index];
            if(!empty($value['progres'.$index])){
                $val1['progres']=$value['progres'.$index]; 
                $this->IndikatorKinerjaModel->editProgres($id,$iku,$val1); 
            }
            if(!empty($value['kendala'.$index])){
                $val2['kendala']=$value['kendala'.$index];
                $this->IndikatorKinerjaModel->editKendala($id,$iku,$val2);  
            }
            if(!empty($value['strategi'.$index])){
                $val3['strategi']=$value['strategi'.$index];
                $this->IndikatorKinerjaModel->editStrategi($id,$iku,$val3);  
            }
            d($value,$index,$id);
            
        }
        return redirect()->to(base_url('/backup'))->withInput();
    }

    public function editIKK()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt => $value)
        {
            $index=$value['index'];
            $id=$value['id'.$index];
            $iku=$value['iku'.$index];
            if(!empty($value['ikk'.$index])){
                $val['indikator']=$value['ikk'.$index];  
            }
            if(!empty($value['target_pk'.$index])){
                $val['target_pk']=$value['target_pk'.$index];  
            }
            if(!empty($value['target_tw'.$index])){
                $val['target_tw']=$value['target_tw'.$index];  
            }
            if(!empty($value['capaian_tw'.$index])){
                $val['capaian']=$value['capaian_tw'.$index];  
            }
            if(!empty($value['presentase_tw'.$index])){
                $val['presentase']=$value['presentase_tw'.$index];  
            }
            if(!empty($value['komentar'.$index])){
                $val['komentar']=$value['komentar'.$index];  
            }
            d($value,$index,$id,$val);
            $this->IndikatorKinerjaModel->edit($id,$iku,$val);
        }
        return redirect()->to(base_url('/backup'))->withInput();
    }
    
    public function storeMultipleImage()
    {
        $data[]=$this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
        // helper(['form', 'url']);
        
        foreach($data as $dt => $value)
        {
            $index=$value['index'];
            $id=$value['id'.$index];
            $iku=$value['iku'.$index];
            $tahun=$value['tahun'.$index];
        }

        d($this->request->getFileMultiple('foto1[]'),$this->request->getFiles('foto1[]'));
        if (null!=$this->request->getFiles('foto1[]')) {
            $imagefile = $this->request->getFiles('foto1[]');
            foreach($imagefile as $if)
            {

                foreach ($if as $img=>$file) {
                    if ($file->isValid() && !($file->hasMoved())) 
                    {
                        $newName = $file->getRandomName();
                        $path='/uploads';
                        $file->store('../../public'.$path, $newName);
                        $data = [
                            'foto' =>  $file->getClientName(),
                            'iku' => $iku,
                            'id_pengguna'=> $id,
                            'lokasi'=>$path.'/'.$newName,
                            'tahun'=> $tahun
                        ];
                        d($data); 
                        $save = $builder->insert($data);  
                    }
                }
            }
        }
        return redirect()->to(base_url('/backup'))->withInput();
 
     }
    public function deleteImage()
    {
        $data[]=$this->request->getPost();
        d($data);
        foreach($data as $dt=>$value)
        {
            $index=$value['index'];
            $id_pengguna=$value['id_pengguna'.$index];
            $id_ft=$value['id_ft'.$index];
            $iku=$value['iku'.$index];
            $tahun=$value['tahun'.$index];
            $foto=$value['foto'.$index];
            $lokasi=$value['lokasi'.$index];
            
            d($value, $lokasi);       
        }
        $data=[
            'table'=>'foto',
            'id_ft'=>$id_ft,
            'id_pengguna' => $id_pengguna,
            'iku'=> $iku
        ];
        $builder =$this->IndikatorKinerjaModel->deleteImage($data);
        $path=str_replace(' ','','/var/www/ciapp/public'.$lokasi);
        unlink($path);
        return redirect()->to(base_url('/backup'));
    }

     public function storeMultipleFile()
     {
         $data[]=$this->request->getPost();
         $db      = \Config\Database::connect();
         $builder = $db->table('dokumen');
         
         foreach($data as $dt => $value)
         {
             $index=$value['index'];
             $id=$value['id'.$index];
             $iku=$value['iku'.$index];
             $tahun=$value['tahun'.$index];
         }
         d($this->request->getFileMultiple('doc1[]'),$this->request->getFiles('doc1[]'));
         if (null!=$this->request->getFiles('doc1[]')) {
             $docfile = $this->request->getFiles('doc1[]');
             foreach($docfile as $df)
          {
             foreach ($df as $doc=>$file) {
                  if ($file->isValid() && !($file->hasMoved())) {
                     
                     $newName = $file->getRandomName();
                     $path='/uploads/file';
                     $file->store('../../public'.$path, $newName);
                     $data = [
                         'dokumen' =>  $file->getClientName(),
                         'iku' => $iku,
                         'id_pengguna'=> $id,
                         'lokasi'=>$path.'/'.$newName,
                         'tahun'=> $tahun
                       ];
                     d($data); 
                     $save = $builder->insert($data);
                      
                  }
         }
        }
         }
         return redirect()->to(base_url('/backup'))->withInput();
  
      }

    public function deleteDokumen()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt=>$value)
        {
            $index=$value['index'];
            $id_pengguna=$value['id_pengguna'.$index];
            $id_dk=$value['id_dk'.$index];
            $iku=$value['iku'.$index];
            $tahun=$value['tahun'.$index];
            $foto=$value['doc'.$index];
            $lokasi=$value['lokasi'.$index];
            
            d($value, $lokasi);       
        }
        $data=[
            'table'=>'dokumen',
            'id_pengguna'=> $id_pengguna,
            'id_dk' => $id_dk,
            'iku'=> $iku
        ];
        $builder =$this->IndikatorKinerjaModel->deleteDoc($data);
        $path=str_replace(' ','','/var/www/ciapp/public'.$lokasi);
        unlink($path);
        return redirect()->to(base_url('/backup'));
    }
    
}
