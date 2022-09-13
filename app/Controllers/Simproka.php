<?php

namespace App\Controllers;
use App\Models\SimprokaModel;
use App\Models\UsersModel;
use CodeIgniter\Files\FileCollection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Simproka extends BaseController
{
    private $session=null;
    // require_once "vendor/autoload.php";
    // require_once "config.php";
    
    //konstraktor
    public function __construct()
    {
        helper('url');
        $this->SimprokaModel= new SimprokaModel();
        $this->UsersModel= new UsersModel();
        $this->session=session();
        $this->id_pengguna=$this->session->get('id_pengguna');
        $this->ket_pengguna=$this->session->get('ket_pengguna');
        $this->tahun=$this->session->get('tahun');
        // $this->bulan=$this->session->get('bulan');
        $this->bulan=7;
        $this->sistem=$this->session->get('sistem');
        $this->detail=$this->session->get('detail');
        $this->data=[];
    }
    public function cobain($data=null){
        // $detail=$this->request->get();
        // dd($detail);
        if(isset($data)){
            d($data);
        }
        $data=$this->data;
        d($this->data);
        return view('pages/simprokaDetail',$data);
    }
    public function detail($getValue=null){
        $data['data']=[];
        if(!empty($getValue)){
            d($getValue);
            foreach ($getValue as $gv => $value) {
                $params['kro']=$value['KRO'];
            }
            $params=[
                'tahun'     => $this->tahun,
                'sistem'    => $this->bulan
            ];
            $query=$this->SimprokaModel->getAll('ro',$params);
            $data['data']=$query->getResultArray();
            $data['sistem']=$this->bulan;
            $data['tahun']=$this->tahun;
            $data['kode']=0;
            $data['file']=[];
            $data['akhir']=0;
            return $data;
            // $this->detailPage($data);
            // return view('pages/simprokaDetail',$data);
        }
        $data['kode']=0;
            $data['file']=[];
            $data['akhir']=0;
            // $this->detailPage($data);
            return $data;
        // return view('pages/simprokaDetail',$data);
        
    }
    public function detailPage($getValue=null){
        if(!empty($getValue)){
            return redirect()->to(base_url('/simprokaDetail'))->withInput();
        }
        $data[]=$this->request->getPost();
        d($data);
        $this->data=$this->detail($data);
        // return ('pages/simprokaDetail',$data);
        return redirect()->to(base_url('/simprokaDetail'))->withInput();
    }
    public function editPage(){
        $data[]=$this->request->getPost();
        // d($data);
        $this->edit($data);
        return redirect()->to(base_url('/simprokaEdit'))->withInput();
    }
    public function edit($data=null){
        if(isset($data)){
            d($data);
        }
        return view('pages/simproka-edit');
    }
    //fungsi tampilan kinerja dengan data
    public function index()
    {
        $params=[
            'tahun'     => $this->tahun,
            'sistem'    => $this->bulan
        ];
        $query=$this->SimprokaModel->getAll('simproka',$params);
        $data['data']=$query->getResultArray();
        $data['sistem']=$this->bulan;
        $data['tahun']=$this->tahun;
        $data['kode']=0;
        $data['file']=[];
        $data['akhir']=0;
        return view('pages/simproka',$data);
        
       
       
    }

    public function countFiles(){
        $sumFiles[]=0;
        $params=[
            'tahun'     => $this->tahun,
            'sistem'    => $this->bulan
        ];
        $query=$this->SimprokaModel->getAll('simproka',$params);
        $simproka=$query->getResultArray();
        foreach ($simproka as $sp => $value) {
            $params['kode']=trim($value['kode']);
            $total=$this->SimprokaModel->countAll('file_simproka',$params);
            // $totaldoc=$this->SimprokaModel->countAll('dokumen',$params);
            $sumFiles[trim($value['kode'])]=$total;
        }
        return $sumFiles;
    }
   
    //fungsi untuk download template excel
    public function downloadFormat(){
        return $this->response->download('../public/uploads/file/Format_Simproka.xlsx', null);
    }

    //fungsi mengubah session triwulan/sistem
    public function aksesData(){
        $detail=$_GET['detail'];
        if(isset($_GET['KRO'])){
            $kode=$_GET['KRO'];
            // dd($kode);
            $this->session->set('kode', $kode);
        }
        $this->session->set('detail', $detail);
        return redirect()->to(base_url('/simproka'))->withInput();
    }

    public function writeExcel()
    {
        require_once "../vendor/autoload.php";
        $spreadsheet = new Spreadsheet();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $activeSheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style judul
        $style_title= [
            'font' => [
                'bold'  => true,
                'size'  => 15,
                'name'  => 'Calibri'
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border top dengan garis tipis
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '0070C0',
                ],
                'endColor' => [
                    'argb' => '0070C0',
                ],
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row_center= [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] 
            ]
        ];

        $style_row_left= [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        
        //judul
        $title='PENGUKURAN KINERJA TRIWULAN '.$this->sistem.' TAHUN '.$this->tahun;
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:O2'); // Set Merge Cell pada kolom A1 sampai F1
        $activeSheet->getStyle('A2')->applyFromArray($style_title);

                $activeSheet->setCellValue('A4', 'No');
                $activeSheet->mergeCells('A4:A5');
                $activeSheet->setCellValue('B4', 'Kode SK');
                $activeSheet->mergeCells('B4:B5');
                $activeSheet->setCellValue('C4', 'Sasaran Kinerja (SK)');
                $activeSheet->mergeCells('C4:C5');
                $activeSheet->setCellValue('D4', 'Kode IKU');
                $activeSheet->mergeCells('D4:D5');
                $activeSheet->setCellValue('E4', 'Indikator Kinerja Kegiatan (IKK)');
                $activeSheet->mergeCells('E4:E5');
                $activeSheet->setCellValue('F4', 'Target PK');
                $activeSheet->mergeCells('F4:F5');
                $activeSheet->setCellValue('G4', 'Target TW.'.$this->sistem);
                $activeSheet->mergeCells('G4:G5');
                $activeSheet->setCellValue('H4', 'Capaian TW.'.$this->sistem);
                $activeSheet->mergeCells('H4:H5');
                $activeSheet->setCellValue('I4', 'Presentase Capaian TW.'.$this->sistem);
                $activeSheet->mergeCells('I4:I5');
                $activeSheet->setCellValue('J4', 'Analis Progres Capaian Tri Wulan'.$this->sistem);
                $activeSheet->mergeCells('J4:L4');
                $activeSheet->setCellValue('J5', 'Progres / Kegiatan');
                $activeSheet->setCellValue('K5', 'Kendala / Permasalahan');
                $activeSheet->setCellValue('L5', 'Strategi / Tindak Lanjut');
                $activeSheet->setCellValue('M4', 'Data Dukung Capaian');
                $activeSheet->mergeCells('M4:N4');
                $activeSheet->setCellValue('M5', 'Dokumen');
                $activeSheet->setCellValue('N5', 'Foto  kegiatan');
                $activeSheet->setCellValue('O4', 'PIC');
                $activeSheet->mergeCells('O4:O5');
                $activeSheet->setCellValue('P4', 'Komentar');
                $activeSheet->mergeCells('P4:P5');
                
                for($i=4; $i<=5; $i++){
                    $activeSheet->getStyle('A'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('B'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('C'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('D'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('E'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('F'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('G'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('H'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('I'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('J'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('K'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('L'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('M'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('N'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('O'.$i)->applyFromArray($style_col);
                    $activeSheet->getStyle('P'.$i)->applyFromArray($style_col);
                }
                $paramsIKK=[
                    'tahun_pengukuran'     => $this->tahun,
                    'sistem_pengukuran'    => $this->sistem,
                    'tahun'     => $this->tahun,
                    'sistem'    => $this->sistem
                ];
                $query = $this->SimprokaModel->getIKK($paramsIKK);
                $ikk=$query->getResultArray();
                $index=6;
                foreach ($ikk as $ik => $value) {
                    $activeSheet->setCellValue('A'.$index, $index-5);
                    $activeSheet->setCellValue('B'.$index, trim($value['kode_sk']));
                    $activeSheet->setCellValue('C'.$index, trim($value['sk']));
                    $activeSheet->setCellValue('D'.$index, trim($value['iku']));
                    $activeSheet->setCellValue('E'.$index, trim($value['indikator']));
                    $activeSheet->setCellValue('F'.$index, trim($value['target_pk']));
                    $activeSheet->setCellValue('G'.$index, trim($value['target_tw']));
                    $activeSheet->setCellValue('H'.$index, trim($value['capaian']));
                    $activeSheet->setCellValue('I'.$index, trim($value['presentase']));
                    $activeSheet->setCellValue('J'.$index, trim($value['progres']));
                    $activeSheet->setCellValue('K'.$index, trim($value['kendala']));
                    $activeSheet->setCellValue('L'.$index, trim($value['strategi']));
                    $activeSheet->setCellValue('O'.$index, trim($value['pic']));
                    $activeSheet->setCellValue('P'.$index, trim($value['komentar']));
                    $activeSheet->getStyle('A'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('B'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('C'.$index)->applyFromArray($style_row_left);
                    $activeSheet->getStyle('D'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('E'.$index)->applyFromArray($style_row_left);
                    $activeSheet->getStyle('F'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('G'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('H'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('I'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('J'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('K'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('L'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('M'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('N'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('O'.$index)->applyFromArray($style_row_center);
                    $activeSheet->getStyle('P'.$index)->applyFromArray($style_row_center);
                    $index++;
                }
                
                //mengatur warptext disetiap kolom
                foreach (range('A', $activeSheet->getHighestDataColumn()) as $col) {
                    $activeSheet->getStyle($col)->getAlignment()->setWrapText(true);
                }
                
                //mengatur weight pada cell
                $activeSheet->getColumnDimension('C')->setWidth(25);
                $activeSheet->getColumnDimension('E')->setWidth(40);
                $activeSheet->getColumnDimension('I')->setWidth(13);
                $activeSheet->getColumnDimension('J')->setWidth(11);
                $activeSheet->getColumnDimension('K')->setWidth(15);

                $activeSheet->getColumnDimension('P')->setWidth(50);

                $filename = $title.'.xlsx';
                
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename='. $filename);
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
                die;
    }
    
    //function membaca excel dan menambahkan ke database
    public function readExcel()
    {
        $userQuery=$this->UsersModel->getUsers();
        $data=$userQuery->getRow();
        $id_pengguna= str_replace(' ','',$data->keterangan);

        //validation submit
        $input = $this->validate([
            'excel' => [
                'rules'=>'uploaded[excel]|ext_in[excel,xls,xlsx]',
                'errors'=>[
                    'uploaded'  => 'Pilih file excel terlebih dahulu!',
                    'ext_in'   => 'Mohon pilih file dengan tipe excel!'
                ]
            ]
        ]);
        
        if (!$input) {
            return  redirect()->to(base_url('/simproka'))->withInput();
        }

        $fileExcel = $this->request->getFile('excel');
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!'); //set pesan berhasil tambah data
       
        // looping untuk mengambil data
        $spreadsheet = IOFactory::load($fileExcel);
        $sheet =  $spreadsheet->getActiveSheet()->toArray(0, true, true, true);
        $indexLoop=1;
        $oldSK;
        foreach ($sheet as $idx => $row) {
            //skip index sampai 5 tidak terpakai
            if (($idx <= 5)||(empty($row['C']))) {
                continue;
            }
            
            if(!empty($row['C'])){
                //menyimpan data excel ke $data yang akan dimasukkan ke db
                $data=[
                    'kode'              => $row['B'],
                    'uraian'            => $row['C'],
                    'satuan'            => $row['D'],
                    'volume_target'     => $row['E'],
                    'pic'               => $row['Q'],
                    'sistem'            => $this->bulan,
                    'tahun'             => $this->tahun
                ];
                
            }
            // if(empty($row['B'])){
            //     $data['detail']='SUBKOMPONEN';
            //     $data['kode']=$oldKode.'.'.$lastB;
            // }else 
            if(trim(strlen($row['B'])==1)){
                $data['detail']='SUBKOMPONEN';
                $data['kode']=$oldKode.'.'.$row['B'];
                $data['komponen']=$oldKode;
                $this->SimprokaModel->insertAll('subkomponen',$data);
                $lastB=$row['B'];
            } else{
                $oldKode=$row['B'];
                $data['detail']='OTHER'; 
            }
            $kode=explode('.',$row['B']);
            // dd($kode);
            if(isset($kode[4])){
                $data['detail']='KOMPONEN';
                $data['ro']=$kode[1].'.'.$kode[2].'.'.$kode[3];
                $this->SimprokaModel->insertAll('komponen',$data);
            }
            else if(isset($kode[3])){
                $data['detail']='RO';
                $data['kro']=$kode[1].'.'.$kode[2];
                $this->SimprokaModel->insertAll('ro',$data);
            }
            else if(isset($kode[2])){
                $data['detail']='KRO';
                $this->SimprokaModel->insertAll('simproka',$data);
            }
            
            $indexLoop++;
        }
        return redirect()->to(base_url('/simproka'));
    }

    //fungsi menghapus data
    public function deleteAll()
    {
        $password=$this->request->getPost('password');
        $query=$this->UsersModel->getUsers();
        $user=$query->getRow();
        $hapusDokumen=$this->request->getPost('hapusDokumen');

        $input = $this->validate([
            'password' => [
                'rules'=>'required|min_length[8]|max_length[8]',
                'errors'=>[
                    'required'      => 'Password harus diisi!',
                    'min_length'    => 'Password terlalu pendek!',
                    'max_length'    => 'Password terlalu panjang!'
                ]
                ]
        ]);
        
        if (!$input) {
            $this->session->setFlashdata('errorPW', 'Tidak dapat menghapus data karena password yang Anda masukkan salah!');
            return  redirect()->to(base_url('/simproka'))->withInput();
        }

        $params=[
            'tahun'     =>$this->tahun,
            'sistem'    =>$this->bulan
        ];
        if(sha1($password)==$user->password){
            if($hapusDokumen=="true")
            {
                $query =$this->SimprokaModel->getAll('file_simproka',$params);
                $files=$query->getResultArray();
                foreach($files as $fl=>$value)
                {
                    $lokasi=$value['lokasi'];    
                    $path=str_replace(' ','','/var/www/ciapp3/public'.$lokasi);
                    if(file_exists($path))
                    {
                        unlink($path);
                    }
                }
                $builder =$this->SimprokaModel->deleteAll('file_simproka',$params);
            }
            $this->SimprokaModel->deleteAll('simproka',$params);
        }

        return redirect()->to(base_url('/simproka'));    
    }

    public function deletePaksa()
    {
        $params=[
            'tahun'     =>$this->tahun
        ];

                $builder =$this->SimprokaModel->deleteAll('file_simproka',$params); 
                return redirect()->to(base_url('/simproka'));   
    }

    //fungsi menyimpan detail(progres kendala strategi)
    public function saveDetail()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt => $value)
        {
            $index=$value['index'];
            $params=[
                'id_pengguna'   => $value['id'.$index],
                'iku'           => $value['iku'.$index],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if(!empty($value['progres'.$index])){
                $val1['progres']=$value['progres'.$index];
                if(!empty($value['deskripsi'.$index])){
                    $val1['deskripsi']=$value['deskripsi'.$index];
                }
                $this->SimprokaModel->updateAll('progres',$params, $val1); 
            }
            if(!empty($value['kendala'.$index])){
                $val2['kendala']=$value['kendala'.$index];
                $this->SimprokaModel->updateAll('kendala',$params, $val2);   
            }
            if(!empty($value['strategi'.$index])){
                $val3['strategi']=$value['strategi'.$index];
                $this->SimprokaModel->updateAll('strategi',$params, $val3); 
            } 
        }
        return redirect()->to(base_url('/simproka'))->withInput();
    }

    //fungsi untuk edit isian table kinerja
    public function editSimproka()
    {
        $data[]=$this->request->getPost();
        d($data);
        foreach($data as $dt => $value)
        {
            d($value);
            $params=[
                'tahun'         => $this->tahun,
                'kode'           => $value['kode']
            ];
            
            $val['kode']=$value['kode'];  
            if(!empty($value['newKode'])){
                $val['kode']=$value['newKode'];  
            }
            if(!empty($value['uraian'])){
                $val['uraian']=$value['uraian'];  
            }
            if(!empty($value['satuan'])){
                $val['satuan']=$value['satuan'];  
            }
            if(!empty($value['volume_target'])){
                $val['volume_target']=$value['volume_target'];  
            }
            if(!empty($value['capaian_volume'])){
                $val['capaian_volume']=$value['capaian_volume'];  
            }
            if(!empty($value['progres'])){
                $val['progres']=$value['progres'];  
            }
            if(!empty($value['capaian_rill'])){
                $val['capaian_rill']=$value['capaian_rill'];  
            }
            if(!empty($value['satuan_rill'])){
                $val['satuan_rill']=$value['satuan_rill'];  
            }
            if(!empty($value['status'])){
                $val['status']=$value['status'];  
            }
            if(!empty($value['penjelasan'])){
                $val['penjelasan']=$value['penjelasan'];  
            }
            if(!empty($value['kendala'])){
                $val['kendala']=$value['kendala'];  
            }
            if(!empty($value['tindak_lanjut'])){
                $val['tindak_lanjut']=$value['tindak_lanjut'];  
            }

            if(!empty($value['kodeSebelum'])){
                $paramsZ=[
                    'tahun'         => $this->tahun,
                    'kode'          => $value['kodeSebelum']
                ];
                $valZ['status_validasi']='belum mengajukan'; 
                $this->SimprokaModel->updateAll('simproka',$paramsZ,$valZ); 
            }
             
            $this->SimprokaModel->updateAll('simproka',$params,$val);
            


        }
        return redirect()->to(base_url('/simproka'))->withInput();
    }
    
//fungsi untuk edit isian table kinerja
public function insertSimproka()
{
    $data[]=$this->request->getPost();
    d($data);
    foreach($data as $dt => $value)
    {
        // if($value['detail']='RO'){
            if (isset($value['kode1'])) {
                # code...
                $value['kode']=$value['kode1'].'.'.$value['kode2'];
            }
        // }
        $val=[
            'tahun'         => $this->tahun,
            'sistem'        => $this->bulan,
            'detail'        => $value['detail'],
            'kode'          => $value['kode'],
            'uraian'        => $value['uraian'],
            'satuan'        => $value['satuan'],
            'volume_target' => $value['volume_target']
        ];
         
        $this->SimprokaModel->insertAll('simproka',$val);
        
    }
    return redirect()->to(base_url('/simproka'))->withInput();
}


    //fungsi menyimpan foto multiple
    public function storeMultipleImage()
    {
        $data[]=$this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
       
        // if (!$input) {
        //     return  redirect()->to(base_url('/simproka'))->withInput();
        // }
        foreach($data as $dt => $value)
        {
            $index=$value['index'];
            $id=$value['id'.$index];
            $iku=$value['iku'.$index];
        //       //validation submit
        //  $input = $this->validate([
        //     'foto[]'.$index => [
        //         'rules'=>'uploaded[foto[]'.$index']|max_size[foto[]'.$index',2048]',
        //         'errors'=>[
        //             'uploaded'  => 'Pilih file excel terlebih dahulu!',
        //             'max_size'   => 'Ukuran foto terlalu besar!'
        //         ]
        //     ]
        // ]);
        
        }
        if (null!=$this->request->getFiles('ft[]')) {
            $imagefile = $this->request->getFiles('ft[]');
            foreach($imagefile as $if)
            {

                foreach ($if as $img=>$file) 
                {
                    if ($file->isValid() && !($file->hasMoved())) 
                    {
                        $size = $file->getSize();
                        $newName = $file->getRandomName();
                        $path='/uploads';
                        $file->store('../../public'.$path, $newName);
                        $data = [
                            'foto' =>  $file->getClientName(),
                            'iku' => $iku,
                            'id_pengguna'=> $id,
                            'lokasi'=>$path.'/'.$newName,
                            'tahun'=> $this->tahun,
                            'sistem'=>$this->sistem
                        ];
                        $save = $this->SimprokaModel->insertAll('foto', $data);  
                    }
                }
            }
        }
        return redirect()->to(base_url('/simproka'))->withInput();
 
    }

    //fungsi delete foto
    public function deleteImage()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt=>$value)
        {
            $index=$value['index'];
            $params=[
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_ft'         => $value['id_ft'.$index],
                'id_pengguna'   => $value['id_pengguna'.$index],
                'iku'           => $value['iku'.$index],
                'foto'          => $value['ft'.$index] 
            ];
            $lokasi=$value['lokasi'.$index];     
        }

        $builder =$this->SimprokaModel->deleteAll('foto',$params);
        $path=str_replace(' ','','/var/www/ciapp3/public'.$lokasi);
        unlink($path); //menghapus file dari penyimpanan
        return redirect()->to(base_url('/simproka'));
    }
    public function downloadImage()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt=>$value)
        {
            $index=$value['index'];
            $params=[
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_ft'         => $value['id_ft'.$index]
            ];
            $lokasi=$value['lokasi'.$index];
        }
        $query =$this->SimprokaModel->getAll('foto',$params);
        $foto=$query->getRow();
        // dd($query->getRow());
        return $this->response->download('../public'.trim($foto->lokasi), null)->setFileName(trim($foto->foto));
    }
    //fungsi menyimpan dokumen multiple
    public function storeMultipleFile()
    {
        $data[]=$this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('file_simproka');
        // dd($data);
        foreach($data as $dt => $value)
        {
            $kode=$value['kode'];
        }
        if (null!=$this->request->getFiles('dok[]')) 
        {
            $docfile = $this->request->getFiles('dok[]');
            foreach($docfile as $df)
            {
                foreach ($df as $doc=>$file) 
                {
                    if ($file->isValid() && !($file->hasMoved())) {
                        
                        $newName = $file->getRandomName();
                        $path='/uploads/file';
                        $file->store('../../public'.$path, $newName);
                        $data = [
                            'file' =>  $file->getClientName(),
                            'kode' => $kode,
                            'lokasi'=>$path.'/'.$newName,
                            'tahun'=> $this->tahun,
                            'sistem'=>$this->bulan
                        ];
                        $save = $this->SimprokaModel->insertAll('file_simproka', $data); 
                    }
                }
            }
        }
        return redirect()->to(base_url('/simproka'))->withInput();
    }

    //fungsi delete dokumen
    public function deleteDokumen()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt=>$value)
        {
            $data=[
                'tahun'         => $this->tahun,
                'sistem'        => $this->bulan,
                'id_file'       => $value['id_file'],
                'kode'          => $value['kode'],
                'file'          => $value['file']
            ];
            $lokasi=$value['lokasi'];    
        }

        $builder =$this->SimprokaModel->deleteAll('file_simproka',$data);
        $path=str_replace(' ','','/var/www/ciapp3/public'.$lokasi);
        if(file_exists($path))
        {
            unlink($path);
        }
        return redirect()->to(base_url('/simproka'));
    }
    
    public function downloadFile()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt=>$value)
        {
            $params=[
                'tahun'         => $this->tahun,
                'sistem'        => $this->bulan,
                'id_file'         => $value['id_file']
            ];
            $lokasi=$value['lokasi'];
        }
        $query =$this->SimprokaModel->getAll('file_simproka',$params);
        $file=$query->getRow();
        // dd($query->getRow());
        return $this->response->download('../public'.trim($file->lokasi), null)->setFileName(trim($file->file)); 
    }

     //fungsi submit 
     public function setStatus()
     {
         $data[]=$this->request->getPost();
         foreach($data as $dt=>$value)
         {
             $index=$value['index'];
             $params=[
                 'tahun_pengukuran'         => $this->tahun,
                 'sistem_pengukuran'        => $this->sistem,
                 'iku'           => $value['iku'.$index],
                 'id_pengguna'   => $value['id'.$index],
             ];  
             $status['status']=$value['status'.$index];
         }
         $builder =$this->SimprokaModel->updateAll('pengukuran',$params, $status);
         return redirect()->to(base_url('/simproka'));
     }
}
