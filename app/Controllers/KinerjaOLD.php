<?php

namespace App\Controllers;
use App\Models\IndikatorKinerjaModel;
use App\Models\UsersModel;
use CodeIgniter\Files\FileCollection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class KinerjaOLD extends BaseController
{
    private $session=null;
    // require_once "vendor/autoload.php";
    // require_once "config.php";
    
    //konstraktor
    public function __construct()
    {
        $this->IndikatorKinerjaModel= new IndikatorKinerjaModel();
        $this->UsersModel= new UsersModel();
        $this->session=session();
        $this->id_pengguna=$this->session->get('id_pengguna');
        $this->ket_pengguna=$this->session->get('ket_pengguna');
        $this->tahun=$this->session->get('tahun');
        $this->sistem=$this->session->get('sistem');
        
    }

    //fungsi tampilan kinerja dengan data
    public function index()
    {
        $userQuery=$this->UsersModel->getUsers();
        $params=[
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
        $fotoQuery=$this->IndikatorKinerjaModel->getAll('foto',$params);
        $Totalfoto=$this->IndikatorKinerjaModel->countAll('foto',$params);
        $docQuery=$this->IndikatorKinerjaModel->getAll('dokumen',$params);
        $paramsSP=[
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem,
            'id_pengguna'=>$this->id_pengguna
        ];
        $sistemQuery=$this->IndikatorKinerjaModel->getAll('sistem_pengguna',$paramsSP);
        $paramsIKK=[
            'tahun_pengukuran'     => $this->tahun,
            'sistem_pengukuran'    => $this->sistem,
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
        // dd($sistemQuery->getResultArray());
        $query = $this->IndikatorKinerjaModel->getIKK($paramsIKK);
        $data=[
            'id_pengguna'   => $this->id_pengguna,
            'ket_pengguna'  => $this->ket_pengguna,
            'tahun'         => $this->tahun,
            'sistem'        => $this->sistem,
            'sistem_pengguna'=> $sistemQuery->getResultArray(),
            'user'          => $userQuery->getResultArray(),
            'data'          => $query->getResultArray(),
            'foto'          => $fotoQuery->getResultArray(),
            'totalFile'     => $this->countFiles(),
            'doc'           => $docQuery->getResultArray()
        ];
        d($data);
        return view('pages/kinerja',$data);
    }

    public function countFiles(){
        $sumFiles[]=0;
        $params=[
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
        $query=$this->IndikatorKinerjaModel->getAll('iku',$params);
        $iku=$query->getResultArray();
        foreach ($iku as $iku => $value) {
            $params['iku']=$value['iku'];
            $totalfoto=$this->IndikatorKinerjaModel->countAll('foto',$params);
            $totaldoc=$this->IndikatorKinerjaModel->countAll('dokumen',$params);
            $sumFiles[$value['iku']]=$totaldoc;
        }
        return $sumFiles;
    }
   
    //fungsi untuk download template excel
    public function downloadFormat(){
        return $this->response->download('../public/uploads/file/Format_Pengukuran_Kinerja_Triwulan_2022.xlsx', null);
    }

    //fungsi mengubah session triwulan/sistem
    public function aksesData(){
        $sistem=intval($_GET['sistem']);
        $this->session->set('sistem', $sistem);
        return redirect()->to(base_url('/KinerjaOLD'))->withInput();
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
                $query = $this->IndikatorKinerjaModel->getIKK($paramsIKK);
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
            return  redirect()->to(base_url('/KinerjaOLD'))->withInput();
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
            if ($idx <= 5) {
                continue;
            }
            if($id_pengguna!=str_replace(' ','',$row['O'])){
                if($id_pengguna!='Admin'){
                    $i++;
                    continue;
                }
            }
           
            //cari id pengguna dari data PIC excel
            // $dataPIC['keterangan']=str_replace(' ','',$row['O']);
            $dataPIC['keterangan']=$row['O'];
            $PIC=str_replace('. ','.', $dataPIC['keterangan']);
            // dd($PIC);
            $multiPIC=explode(' ',$PIC);
            foreach ($multiPIC as $mp=>$vl)
            {
                    $queryID=$this->IndikatorKinerjaModel->getAll('pengguna',array('keterangan'=>$vl));
                    $dataUser=$queryID->getResultArray();
                
                if(empty($dataUser)){
                    continue;
                }
                d($dataUser);
                foreach ($dataUser as $du => $value) {
                    $id=$value['id_pengguna'];
                }
                //cari id KOOR pengguna dari data PIC excel
                $ketID['keterangan']='KOOR '.$vl;
                $queryID=$this->IndikatorKinerjaModel->getAll('pengguna',$ketID);
                d($ketID);
                $dataUser=$queryID->getResultArray();
                foreach ($dataUser as $du => $value) {
                    $idKoor=$value['id_pengguna'];
                }
                //data yang akan ditambahkan ke SISTEM PENGGUNA
                $dataSP=[
                    'iku'           => $row['D'],
                    'tahun'         => $this->tahun,
                    'id_pengguna'   => $id,
                    'sistem'        => $this->sistem
                ];
                $dataSP['id_pengguna']=$id;
                $this->IndikatorKinerjaModel->insertAll('sistem_pengguna',$dataSP);
                $dataSP['id_pengguna']=$idKoor;
                $this->IndikatorKinerjaModel->insertAll('sistem_pengguna',$dataSP);
                
            }
            $dataSP['id_pengguna']=1230;
                $this->IndikatorKinerjaModel->insertAll('sistem_pengguna',$dataSP);
            d($PIC);
            
            
            //memasukkan $data ke database
            if($indexLoop==1){
                $oldSK=$row['B'];
            }
            //if agar sk yang sama tidak disimpan kembali
            if(!empty($oldSK))
            {
                if(($oldSK!=$row['B'])||($indexLoop==1))
                {
                    $dataSK=[
                        'sk'        => $row['C'],
                        'kode_sk'   => $row['B'],
                        'tahun'     => $this->tahun,
                        'sistem'    => $this->sistem
                    ];
                    //memasukkan data sk
                    $this->IndikatorKinerjaModel->insertAll('sasaran_kinerja',$dataSK);
                }
            }
            $oldSK=$row['B'];

            //parameter untuk mencari ID data sk
            $paramSK=[
                'kode_sk'   => $row['B'],
                'tahun'     => $this->tahun,
                'sistem'    => $this->sistem
            ];

            $queryIDSK=$this->IndikatorKinerjaModel->getAll('sasaran_kinerja',$paramSK);
            $dataSasaranKinerja=$queryIDSK->getResultArray();
            foreach ($dataSasaranKinerja as $dsk => $value) {
                $idSK=$value['id_sk'];
            }
        
            //menyimpan data excel ke $data yang akan dimasukkan ke db
            $data=[
                'indikator'         => $row['E'],
                'target_pk'         => $row['F'],
                'target_tw'         => $row['G'],
                'capaian'           => $row['H'],
                'presentase'        => $row['I'],
                'pic'               => $row['O'],
                'id_pengguna'       => $id,
                'iku'               => $row['D'],
                'tahun_pengukuran'  => $this->tahun,
                'sistem_pengukuran' => $this->sistem,
                'status'            => 'belum mengajukan'
            ];
            $this->IndikatorKinerjaModel->insertAll('pengukuran',$data);

            //data yang akan ditambahkan ke iku
            $dataIKU=[
                'iku'           => $row['D'],
                'id_sk'         => $idSK,
                'kode_sk'       => $row['B'],
                'tahun'         => $this->tahun,
                'id_pengguna'   => $id,
                'sistem'        => $this->sistem
            ];
            $this->IndikatorKinerjaModel->insertAll('iku',$dataIKU);
            
            
            //data yang akan ditambahkan ke progres
            $dataProgres=[
                'id_pengguna'   => $id,
                'iku'           => $row['D'],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if($row['J']!=0){
                $dataProgres['progres']=$row['J'];
            }
            $this->IndikatorKinerjaModel->insertAll('progres',$dataProgres);

            //data yang akan ditambahkan ke kendala
            $dataKendala=[
                'id_pengguna'=> $id,
                'iku'       => $row['D'],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if($row['K']!=0){
                $dataKendala['kendala']=$row['K'];
            }
            $this->IndikatorKinerjaModel->insertAll('kendala',$dataKendala);

            //data yang akan ditambahkan ke strategi
            $dataStrategi=[
                'id_pengguna'=> $id,
                'iku'       => $row['D'],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if($row['L']!=0){
                $dataStrategi['strategi']=$row['L'];
            }
            $val3['strategi']=$row['L'];
            $this->IndikatorKinerjaModel->insertAll('strategi',$dataStrategi);
            
            $indexLoop++;
        }
        return redirect()->to(base_url('/KinerjaOLD'));
    }

    //fungsi menghapus data
    public function deleteAll()
    {
        $params=[
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];

        $this->IndikatorKinerjaModel->deleteAll('iku',$params);
        $this->IndikatorKinerjaModel->deleteAll('sasaran_kinerja',$params);
        $this->IndikatorKinerjaModel->deleteAll('progres',$params);
        $this->IndikatorKinerjaModel->deleteAll('kendala',$params);
        $this->IndikatorKinerjaModel->deleteAll('strategi',$params);
        $this->IndikatorKinerjaModel->deleteAll('sistem_pengguna',$params);
        
        $paramsPengukuran=[
            'tahun_pengukuran'     => $this->tahun,
            'sistem_pengukuran'    => $this->sistem
        ];
        $this->IndikatorKinerjaModel->deleteAll('pengukuran',$paramsPengukuran);
        return redirect()->to(base_url('/KinerjaOLD'));    
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
                $this->IndikatorKinerjaModel->updateAll('progres',$params, $val1); 
            }
            if(!empty($value['kendala'.$index])){
                $val2['kendala']=$value['kendala'.$index];
                $this->IndikatorKinerjaModel->updateAll('kendala',$params, $val2);   
            }
            if(!empty($value['strategi'.$index])){
                $val3['strategi']=$value['strategi'.$index];
                $this->IndikatorKinerjaModel->updateAll('strategi',$params, $val3); 
            } 
        }
        return redirect()->to(base_url('/KinerjaOLD'))->withInput();
    }

    //fungsi untuk edit isian table kinerja
    public function editIKK()
    {
        $data[]=$this->request->getPost();
        d($data);
        foreach($data as $dt => $value)
        {
            $index=$value['index'];
            $params=[
                'id_pengguna'   => $value['id'.$index],
                'iku'           => $value['iku'.$index],
                'tahun_pengukuran'         => $this->tahun,
                'sistem_pengukuran'        => $this->sistem
            ];
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
            // if(!empty($value['presentase_tw'.$index])){
            //     $val['presentase']=$value['presentase_tw'.$index];  
            // }
            
            if(!empty($value['komentar'.$index])){
                $val['komentar']=$value['komentar'.$index];  
            }
            if(!empty($value['deskripsi'.$index])){
                $val['deskripsi']=$value['deskripsi'.$index];  
            }
            if(!empty($val)){  
                $this->IndikatorKinerjaModel->updateAll('pengukuran',$params,$val);
            }


            $query=$this->IndikatorKinerjaModel->getAll('pengukuran',$params);
            $data=$query->getResultArray();
            foreach ($data as $dt => $value) {
                $persentase=(intval($value['capaian']!=0))?(floatval($value['capaian'])/floatval($value['target_tw'])*100).'%':0;
                $val['presentase']=$persentase;
            }
            $this->IndikatorKinerjaModel->updateAll('pengukuran',$params,$val);
        }
        return redirect()->to(base_url('/KinerjaOLD'))->withInput();
    }
    
    //fungsi menyimpan foto multiple
    public function storeMultipleImage()
    {
        $data[]=$this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');
       
        // if (!$input) {
        //     return  redirect()->to(base_url('/KinerjaOLD'))->withInput();
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
                        $save = $this->IndikatorKinerjaModel->insertAll('foto', $data);  
                    }
                }
            }
        }
        return redirect()->to(base_url('/KinerjaOLD'))->withInput();
 
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

        $builder =$this->IndikatorKinerjaModel->deleteAll('foto',$params);
        $path=str_replace(' ','','/var/www/ciapp3/public'.$lokasi);
        unlink($path); //menghapus file dari penyimpanan
        return redirect()->to(base_url('/KinerjaOLD'));
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
        $query =$this->IndikatorKinerjaModel->getAll('foto',$params);
        $foto=$query->getRow();
        // dd($query->getRow());
        return $this->response->download('../public'.trim($foto->lokasi), null)->setFileName(trim($foto->foto));
    }
    //fungsi menyimpan dokumen multiple
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
                            'dokumen' =>  $file->getClientName(),
                            'iku' => $iku,
                            'id_pengguna'=> $id,
                            'lokasi'=>$path.'/'.$newName,
                            'tahun'=> $this->tahun,
                            'sistem'=>$this->sistem
                        ];
                        $save = $this->IndikatorKinerjaModel->insertAll('dokumen', $data); 
                    }
                }
            }
        }
        return redirect()->to(base_url('/KinerjaOLD'))->withInput();
    }

    //fungsi delete dokumen
    public function deleteDokumen()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt=>$value)
        {
            $index=$value['index'];
            $data=[
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_pengguna'   => $value['id_pengguna'.$index],
                'id_dk'         => $value['id_dk'.$index],
                'iku'           => $value['iku'.$index],
                'dokumen'       => $value['dok'.$index]
            ];
            $lokasi=$value['lokasi'.$index];    
        }

        $builder =$this->IndikatorKinerjaModel->deleteAll('dokumen',$data);
        $path=str_replace(' ','','/var/www/ciapp3/public'.$lokasi);
        unlink($path);
        return redirect()->to(base_url('/KinerjaOLD'));
    }
    
    public function downloadFile()
    {
        $data[]=$this->request->getPost();
        foreach($data as $dt=>$value)
        {
            $index=$value['index'];
            $params=[
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_dk'         => $value['id_dk'.$index]
            ];
            $lokasi=$value['lokasi'.$index];
        }
        $query =$this->IndikatorKinerjaModel->getAll('dokumen',$params);
        $dokumen=$query->getRow();
        // dd($query->getRow());
        return $this->response->download('../public'.trim($dokumen->lokasi), null)->setFileName(trim($dokumen->dokumen)); 
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
         $builder =$this->IndikatorKinerjaModel->updateAll('pengukuran',$params, $status);
         return redirect()->to(base_url('/KinerjaOLD'));
     }
}
