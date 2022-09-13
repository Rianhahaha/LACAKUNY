<?php

namespace App\Controllers;

use App\Models\KinerjaModel;
use App\Models\UsersModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Files\FileCollection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kinerja extends BaseController
{
    private $session = null;
    // require_once "vendor/autoload.php";
    // require_once "config.php";

    //konstraktor
    public function __construct()
    {

        $this->KinerjaModel = new KinerjaModel();
        $this->UsersModel = new UsersModel();
        $this->session = session();
        $this->id_pengguna = $this->session->get('id_pengguna');
        $this->ket_pengguna = $this->session->get('ket_pengguna');
        $this->tahun = $this->session->get('tahun');
        $this->sistem = $this->session->get('sistem');
    }

    //fungsi tampilan kinerja dengan data
    public function index()
    {
        $language = \Config\Services::language();
        $time = Time::parse('2022-07-26 19:12:22.855459+07:00 WIB');
        $coba = strval($time->humanize());
        d($time->humanize(), $time->toLocalizedString());
        // dd($language->getTranslationOutput('id', 'nothing', $coba));
        $userQuery = $this->UsersModel->getUsers();
        $params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
        $fotoQuery = $this->KinerjaModel->getAll('foto', $params);
        $Totalfoto = $this->KinerjaModel->countAll('foto', $params);
        $docQuery = $this->KinerjaModel->getAll('dokumen', $params);
        $paramsSP = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem,
            'id_pengguna' => $this->id_pengguna
        ];
        $sistemQuery = $this->KinerjaModel->getSP('sistem_pengguna', $paramsSP);
        $dataSP = $sistemQuery->getResultArray();
        foreach ($dataSP as $dsp => $value) {
            $paramsIKK = [
                'tahun_pengukuran'     => $this->tahun,
                'sistem_pengukuran'    => $this->sistem,
                'tahun'     => $this->tahun,
                'sistem'    => $this->sistem,
                'iku'       => $value['iku']
            ];
            // dd($sistemQuery->getResultArray());
            $query = $this->KinerjaModel->getIKK($paramsIKK);
            $ikk[] = $query->getResultArray();
        }
        $data = [
            'id_pengguna'   => $this->id_pengguna,
            'ket_pengguna'  => $this->ket_pengguna,
            'tahun'         => $this->tahun,
            'sistem'        => $this->sistem,
            'sistem_pengguna' => $sistemQuery->getResultArray(),
            'user'          => $userQuery->getResultArray(),
            'foto'          => $fotoQuery->getResultArray(),
            'totalFile'     => $this->countFiles(),
            'doc'           => $docQuery->getResultArray()
        ];
        if (!empty($ikk)) {
            $data['data'] = $ikk;
        } else {
            $data['data'] = [];
        }
        d($data);
        return view('pages/kinerjaCoba', $data);
    }
    //fungsi tampilan kinerja dengan data
    public function tabelKinerja()
    {
        $language = \Config\Services::language();
        $time = Time::parse('2022-07-26 19:12:22.855459+07:00 WIB');
        $coba = strval($time->humanize());
        d($time->humanize(), $time->toLocalizedString());
        // dd($language->getTranslationOutput('id', 'nothing', $coba));
        $userQuery = $this->UsersModel->getUsers();
        $params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
        $fotoQuery = $this->KinerjaModel->getAll('foto', $params);
        $Totalfoto = $this->KinerjaModel->countAll('foto', $params);
        $docQuery = $this->KinerjaModel->getAll('dokumen', $params);
        $paramsSP = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem,
            'id_pengguna' => $this->id_pengguna
        ];
        $sistemQuery = $this->KinerjaModel->getSP('sistem_pengguna', $paramsSP);
        $dataSP = $sistemQuery->getResultArray();
        foreach ($dataSP as $dsp => $value) {
            $paramsIKK = [
                'tahun_pengukuran'     => $this->tahun,
                'sistem_pengukuran'    => $this->sistem,
                'tahun'     => $this->tahun,
                'sistem'    => $this->sistem,
                'iku'       => $value['iku']
            ];
            // dd($sistemQuery->getResultArray());
            $query = $this->KinerjaModel->getIKK($paramsIKK);
            $ikk[] = $query->getResultArray();
        }
        $data = [
            'id_pengguna'   => $this->id_pengguna,
            'ket_pengguna'  => $this->ket_pengguna,
            'tahun'         => $this->tahun,
            'sistem'        => $this->sistem,
            'sistem_pengguna' => $sistemQuery->getResultArray(),
            'user'          => $userQuery->getResultArray(),
            'foto'          => $fotoQuery->getResultArray(),
            'totalFile'     => $this->countFiles(),
            'doc'           => $docQuery->getResultArray()
        ];
        if (!empty($ikk)) {
            $data['data'] = $ikk;
        } else {
            $data['data'] = [];
        }
        d($data);
        return view('pages/tabel', $data);
    }
    public function countFiles()
    {
        $sumFiles[] = 0;
        $params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
        $query = $this->KinerjaModel->getAll('iku', $params);
        $iku = $query->getResultArray();
        foreach ($iku as $iku => $value) {
            $params['iku'] = $value['iku'];
            $totalfoto = $this->KinerjaModel->countAll('foto', $params);
            $totaldoc = $this->KinerjaModel->countAll('dokumen', $params);
            $sumFiles[trim($value['iku'])] = $totaldoc;
        }
        return $sumFiles;
    }

    //fungsi untuk download template excel
    public function downloadFormat()
    {
        return $this->response->download('../public/uploads/file/Format_Pengukuran_Kinerja_Triwulan_2022.xlsx', null);
    }

    //fungsi mengubah session triwulan/sistem
    public function aksesData()
    {
        // $sistem=intval($_GET['sistem']);
        // if ($this->request->isAJAX()) {
        //     $sistem = service('request')->getPost('data');
        //     var_dump($this->request->getPost('data'));
        // }
        $sistem = intval($this->request->getPost('sistem'));
        // $sistem=4;
        // dd($sistem);
        $this->session->set('sistem', $sistem);
        return redirect()->to(base_url('/kinerja'))->withInput();
    }

    public function writeExcel()
    {
        require_once "../vendor/autoload.php";
        $spreadsheet = new Spreadsheet();
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $activeSheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style judul
        $style_title = [
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
        $style_row_center = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'outline' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
            ]
        ];

        $style_row_left = [
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
        $title = 'PENGUKURAN KINERJA TRIWULAN ' . $this->sistem . ' TAHUN ' . $this->tahun;
        $activeSheet->setCellValue('A2', $title); // Set kolom A1 dengan tulisan "DATA SISWA"
        $activeSheet->mergeCells('A2:P2'); // Set Merge Cell pada kolom A1 sampai F1
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
        $activeSheet->setCellValue('G4', 'Target TW.' . $this->sistem);
        $activeSheet->mergeCells('G4:G5');
        $activeSheet->setCellValue('H4', 'Capaian TW.' . $this->sistem);
        $activeSheet->mergeCells('H4:H5');
        $activeSheet->setCellValue('I4', 'Presentase Capaian TW.' . $this->sistem);
        $activeSheet->mergeCells('I4:I5');
        $activeSheet->setCellValue('J4', 'Analis Progres Capaian Tri Wulan' . $this->sistem);
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

        for ($i = 4; $i <= 5; $i++) {
            $activeSheet->getStyle('A' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('B' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('C' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('D' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('E' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('F' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('G' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('H' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('I' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('J' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('K' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('L' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('M' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('N' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('O' . $i)->applyFromArray($style_col);
            $activeSheet->getStyle('P' . $i)->applyFromArray($style_col);
        }
        $paramsIKK = [
            'tahun_pengukuran'     => $this->tahun,
            'sistem_pengukuran'    => $this->sistem,
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
        $query = $this->KinerjaModel->getAllIKK($paramsIKK);
        $ikk = $query->getResultArray();
        $index = 6;
        foreach ($ikk as $ik => $value) {
            $activeSheet->setCellValue('A' . $index, $index - 5);
            $activeSheet->setCellValue('B' . $index, trim($value['kode_sk']));
            $activeSheet->setCellValue('C' . $index, trim($value['sk']));
            $activeSheet->setCellValue('D' . $index, trim($value['iku']));
            $activeSheet->setCellValue('E' . $index, trim($value['indikator']));
            $activeSheet->setCellValue('F' . $index, trim($value['target_pk']));
            $activeSheet->setCellValue('G' . $index, trim($value['target_tw']));
            $activeSheet->setCellValue('H' . $index, trim($value['capaian']));
            $activeSheet->setCellValue('I' . $index, trim($value['presentase']));
            $activeSheet->setCellValue('J' . $index, trim($value['progres']));
            $activeSheet->setCellValue('K' . $index, trim($value['kendala']));
            $activeSheet->setCellValue('L' . $index, trim($value['strategi']));
            $activeSheet->setCellValue('M' . $index, 'Semua data dukung baik foto maupun dokumen dapat dilihat pada website http://8.215.67.23/kinerja.');
            $activeSheet->mergeCells('M' . $index . ':N' . $index);
            $activeSheet->setCellValue('O' . $index, trim($value['pic']));
            $activeSheet->setCellValue('P' . $index, trim($value['komentar']));
            $activeSheet->getStyle('A' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('B' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('C' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('D' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('E' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('F' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('G' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('H' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('I' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('J' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('K' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('L' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('M' . $index)->applyFromArray($style_row_left);
            $activeSheet->getStyle('N' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('O' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('P' . $index)->applyFromArray($style_row_center);
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
        $activeSheet->getColumnDimension('J')->setWidth(70);
        $activeSheet->getColumnDimension('K')->setWidth(70);
        $activeSheet->getColumnDimension('L')->setWidth(70);

        $activeSheet->getColumnDimension('N')->setWidth(15);
        $activeSheet->getColumnDimension('P')->setWidth(50);

        $filename = $title . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        die;
    }

    //function membaca excel dan menambahkan ke database
    public function readExcel()
    {
        $userQuery = $this->UsersModel->getUsers();
        $data = $userQuery->getRow();
        $id_pengguna = str_replace(' ', '', $data->keterangan);

        //validation submit
        $input = $this->validate([
            'excel' => [
                'rules' => 'uploaded[excel]|ext_in[excel,xls,xlsx]',
                'errors' => [
                    'uploaded'  => 'Pilih file excel terlebih dahulu!',
                    'ext_in'   => 'Mohon pilih file dengan tipe excel!'
                ]
            ]
        ]);

        if (!$input) {
            return  redirect()->to(base_url('/kinerja'))->withInput();
        }

        $fileExcel = $this->request->getFile('excel');
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!'); //set pesan berhasil tambah data

        // looping untuk mengambil data
        $spreadsheet = IOFactory::load($fileExcel);
        $sheet =  $spreadsheet->getActiveSheet()->toArray(0, true, true, true);
        $indexLoop = 1;
        $oldSK = 0;;
        foreach ($sheet as $idx => $row) {
            //skip index sampai 5 tidak terpakai
            d($idx);
            if ($idx <= 5) {
                continue;
            }
            // if ($id_pengguna != str_replace(' ', '', $row['O'])) {
            //     if ($id_pengguna != 'Admin') {
            //         $i++;
            //         continue;
            //     }
            // }

            //cari id pengguna dari data PIC excel
            // $dataPIC['keterangan']=str_replace(' ','',$row['O']);
            $dataPIC['keterangan'] = $row['O'];
            $PIC = str_replace('. ', '.', $dataPIC['keterangan']);
            // dd($PIC);
            $multiPIC = explode(' ', $PIC);
            foreach ($multiPIC as $mp => $vl) {
                d($vl);
                $queryID = $this->KinerjaModel->getAll('pengguna', array('keterangan' => trim($vl)));
                $dataUser = $queryID->getResultArray();
                d($dataUser);
                if (empty($dataUser)) {
                    echo "ZONK";
                    continue;
                }
                d($dataUser);
                foreach ($dataUser as $du => $value) {
                    $id = $value['id_pengguna'];
                }
                //cari id KOOR pengguna dari data PIC excel
                $ketID['keterangan'] = 'KOOR ' . $vl;
                $queryID = $this->KinerjaModel->getAll('pengguna', $ketID);
                d($ketID);
                $dataUser = $queryID->getResultArray();
                foreach ($dataUser as $du => $value) {
                    $idKoor = $value['id_pengguna'];
                }
                //data yang akan ditambahkan ke SISTEM PENGGUNA
                $dataSP = [
                    'iku'           => $row['D'],
                    'tahun'         => $this->tahun,
                    'id_pengguna'   => $id,
                    'sistem'        => $this->sistem
                ];
                $dataSP['id_pengguna'] = $id;
                $this->KinerjaModel->insertAll('sistem_pengguna', $dataSP);
                $dataSP['id_pengguna'] = $idKoor;
                $this->KinerjaModel->insertAll('sistem_pengguna', $dataSP);
            }
            $dataSP['id_pengguna'] = 1230;
            $this->KinerjaModel->insertAll('sistem_pengguna', $dataSP);
            // dd($PIC);


            //memasukkan $data ke database
            if ($indexLoop == 1) {
                $oldSK = $row['B'];
            }
            //if agar sk yang sama tidak disimpan kembali
            if (!empty($oldSK)) {
                if (($oldSK != $row['B']) || ($indexLoop == 1)) {
                    $dataSK = [
                        'sk'        => $row['C'],
                        'kode_sk'   => $row['B'],
                        'tahun'     => $this->tahun,
                        'sistem'    => $this->sistem
                    ];
                    //memasukkan data sk
                    $this->KinerjaModel->insertAll('sasaran_kinerja', $dataSK);
                }
            }
            $oldSK = $row['B'];

            //parameter untuk mencari ID data sk
            $paramSK = [
                'kode_sk'   => $row['B'],
                'tahun'     => $this->tahun,
                'sistem'    => $this->sistem
            ];

            $queryIDSK = $this->KinerjaModel->getAll('sasaran_kinerja', $paramSK);
            $dataSasaranKinerja = $queryIDSK->getResultArray();
            foreach ($dataSasaranKinerja as $dsk => $value) {
                $idSK = $value['id_sk'];
            }

            //menyimpan data excel ke $data yang akan dimasukkan ke db
            $data = [
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
            $this->KinerjaModel->insertAll('pengukuran', $data);

            //data yang akan ditambahkan ke iku
            $dataIKU = [
                'iku'           => $row['D'],
                'id_sk'         => $idSK,
                'kode_sk'       => $row['B'],
                'tahun'         => $this->tahun,
                'id_pengguna'   => $id,
                'sistem'        => $this->sistem
            ];
            $this->KinerjaModel->insertAll('iku', $dataIKU);


            //data yang akan ditambahkan ke progres
            $dataProgres = [
                'id_pengguna'   => $id,
                'iku'           => $row['D'],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if ($row['J'] != 0) {
                $dataProgres['progres'] = $row['J'];
            }
            $this->KinerjaModel->insertAll('progres', $dataProgres);

            //data yang akan ditambahkan ke kendala
            $dataKendala = [
                'id_pengguna' => $id,
                'iku'       => $row['D'],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if ($row['K'] != 0) {
                $dataKendala['kendala'] = $row['K'];
            }
            $this->KinerjaModel->insertAll('kendala', $dataKendala);

            //data yang akan ditambahkan ke strategi
            $dataStrategi = [
                'id_pengguna' => $id,
                'iku'       => $row['D'],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if ($row['L'] != 0) {
                $dataStrategi['strategi'] = $row['L'];
            }
            $val3['strategi'] = $row['L'];
            $this->KinerjaModel->insertAll('strategi', $dataStrategi);

            $indexLoop++;
        }
        dd($indexLoop);
        return redirect()->to(base_url('/kinerja'));
    }

    //fungsi menghapus data
    public function deleteAll()
    {

        $password = $this->request->getPost('password');
        $query = $this->UsersModel->getUsers();
        $user = $query->getRow();
        $hapusDokumen = $this->request->getPost('hapusDokumen');

        $input = $this->validate([
            'password' => [
                'rules' => 'required|min_length[8]|max_length[8]',
                'errors' => [
                    'required'      => 'Password harus diisi!',
                    'min_length'    => 'Password terlalu pendek!',
                    'max_length'    => 'Password terlalu panjang!'
                ]
            ]

        ]);

        if (!$input) {
            $this->session->setFlashdata('errorPW', 'Tidak dapat menghapus data karena password yang Anda masukkan salah!');
            return  redirect()->to(base_url('/kinerja'))->withInput();
        }

        if (sha1($password) == $user->password) {
            $params = [
                'tahun'     => $this->tahun,
                'sistem'    => $this->sistem
            ];
            if ($hapusDokumen == "true") {
                $query = $this->KinerjaModel->getAll('dokumen', $params);
                $files = $query->getResultArray();
                foreach ($files as $fl => $value) {
                    $lokasi = $value['lokasi'];
                    $path = str_replace(' ', '', '/var/www/ciapp3/public' . $lokasi);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $builder = $this->KinerjaModel->deleteAll('dokumen', $params);
            }
            $this->KinerjaModel->deleteAll('iku', $params);
            $this->KinerjaModel->deleteAll('sasaran_kinerja', $params);
            $this->KinerjaModel->deleteAll('progres', $params);
            $this->KinerjaModel->deleteAll('kendala', $params);
            $this->KinerjaModel->deleteAll('strategi', $params);
            $this->KinerjaModel->deleteAll('sistem_pengguna', $params);

            $paramsPengukuran = [
                'tahun_pengukuran'     => $this->tahun,
                'sistem_pengukuran'    => $this->sistem
            ];
            $this->KinerjaModel->deleteAll('pengukuran', $paramsPengukuran);
        }

        return redirect()->to(base_url('/kinerja'));
    }

    //fungsi menyimpan detail(progres kendala strategi)
    public function saveDetail()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $params = [
                'id_pengguna'   => $value['id' . $index],
                'iku'           => $value['iku' . $index],
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem
            ];
            if (!empty($value['progres' . $index])) {
                $val1['progres'] = $value['progres' . $index];
                if (!empty($value['deskripsi' . $index])) {
                    $val1['deskripsi'] = $value['deskripsi' . $index];
                }
                $this->KinerjaModel->updateAll('progres', $params, $val1);
            }
            if (!empty($value['kendala' . $index])) {
                $val2['kendala'] = $value['kendala' . $index];
                $this->KinerjaModel->updateAll('kendala', $params, $val2);
            }
            if (!empty($value['strategi' . $index])) {
                $val3['strategi'] = $value['strategi' . $index];
                $this->KinerjaModel->updateAll('strategi', $params, $val3);
            }
        }
        return redirect()->to(base_url('/kinerja'))->withInput();
    }

    //fungsi untuk edit isian table kinerja
    public function editIKK()
    {
        $data[] = $this->request->getPost();
        d($data);
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $params = [
                'id_pengguna'   => $value['id' . $index],
                'iku'           => $value['iku' . $index],
                'tahun_pengukuran'         => $this->tahun,
                'sistem_pengukuran'        => $this->sistem
            ];
            if (!empty($value['ikk' . $index])) {
                $val['indikator'] = $value['ikk' . $index];
            }
            if (!empty($value['target_pk' . $index])) {
                $val['target_pk'] = $value['target_pk' . $index];
            }
            if (!empty($value['target_tw' . $index])) {
                $val['target_tw'] = str_replace(",", ".", $value['target_tw' . $index]);
            }
            if (!empty($value['capaian_tw' . $index])) {
                $val['capaian'] = str_replace(",", ".", $value['capaian_tw' . $index]);
            }
            // if(!empty($value['presentase_tw'.$index])){
            //     $val['presentase']=$value['presentase_tw'.$index];  
            // }

            if (!empty($value['komentar' . $index])) {
                $val['komentar'] = $value['komentar' . $index];
            }
            if (!empty($value['deskripsi' . $index])) {
                $val['deskripsi'] = $value['deskripsi' . $index];
            }
            if (!empty($val)) {
                $this->KinerjaModel->updateAll('pengukuran', $params, $val);
            }


            $query = $this->KinerjaModel->getAll('pengukuran', $params);
            $data = $query->getResultArray();
            foreach ($data as $dt => $value) {
                $coba =
                    $persentase = (intval($value['capaian'] != 0)) ? (round((floatval($value['capaian'])) / (floatval($value['target_tw'])) * 100.00, 2)) . '%' : 0;
                $val['presentase'] = $persentase;
            }
            $this->KinerjaModel->updateAll('pengukuran', $params, $val);
        }
        return redirect()->to(base_url('/kinerja'))->withInput();
    }

    //fungsi menyimpan foto multiple
    public function storeMultipleImage()
    {
        $data[] = $this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');

        // if (!$input) {
        //     return  redirect()->to(base_url('/kinerja'))->withInput();
        // }
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $id = $value['id' . $index];
            $iku = $value['iku' . $index];
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
        if (null != $this->request->getFiles('ft[]')) {
            $imagefile = $this->request->getFiles('ft[]');
            foreach ($imagefile as $if) {

                foreach ($if as $img => $file) {
                    if ($file->isValid() && !($file->hasMoved())) {
                        $size = $file->getSize();
                        $newName = $file->getRandomName();
                        $path = '/uploads';
                        $file->store('../../public' . $path, $newName);
                        $data = [
                            'foto' =>  $file->getClientName(),
                            'iku' => $iku,
                            'id_pengguna' => $id,
                            'lokasi' => $path . '/' . $newName,
                            'tahun' => $this->tahun,
                            'sistem' => $this->sistem
                        ];
                        $save = $this->KinerjaModel->insertAll('foto', $data);
                    }
                }
            }
        }
        return redirect()->to(base_url('/kinerja'))->withInput();
    }

    //fungsi delete foto
    public function deleteImage()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $params = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_ft'         => $value['id_ft' . $index],
                'id_pengguna'   => $value['id_pengguna' . $index],
                'iku'           => $value['iku' . $index],
                'foto'          => $value['ft' . $index]
            ];
            $lokasi = $value['lokasi' . $index];
        }

        $builder = $this->KinerjaModel->deleteAll('foto', $params);
        $path = str_replace(' ', '', '/var/www/ciapp3/public' . $lokasi);
        unlink($path); //menghapus file dari penyimpanan
        return redirect()->to(base_url('/kinerja'));
    }
    public function downloadImage()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $params = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_ft'         => $value['id_ft' . $index]
            ];
            $lokasi = $value['lokasi' . $index];
        }
        $query = $this->KinerjaModel->getAll('foto', $params);
        $foto = $query->getRow();
        // dd($query->getRow());
        return $this->response->download('../public' . trim($foto->lokasi), null)->setFileName(trim($foto->foto));
    }
    //fungsi menyimpan dokumen multiple
    public function storeMultipleFile()
    {
        $data[] = $this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('dokumen');

        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $id = $value['id' . $index];
            $iku = $value['iku' . $index];
        }
        if (null != $this->request->getFiles('dok[]')) {
            $docfile = $this->request->getFiles('dok[]');
            foreach ($docfile as $df) {
                foreach ($df as $doc => $file) {
                    if ($file->isValid() && !($file->hasMoved())) {

                        $newName = $file->getRandomName();
                        $path = '/uploads/file';
                        $file->store('../../public' . $path, $newName);
                        $data = [
                            'dokumen' =>  $file->getClientName(),
                            'iku' => $iku,
                            'id_pengguna' => $id,
                            'lokasi' => $path . '/' . $newName,
                            'tahun' => $this->tahun,
                            'sistem' => $this->sistem
                        ];
                        $save = $this->KinerjaModel->insertAll('dokumen', $data);
                    }
                }
            }
        }
        return redirect()->to(base_url('/kinerja'))->withInput();
    }

    //fungsi delete dokumen
    public function deleteDokumen()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $data = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_pengguna'   => $value['id_pengguna' . $index],
                'id_dk'         => $value['id_dk' . $index],
                'iku'           => $value['iku' . $index],
                'dokumen'       => $value['dok' . $index]
            ];
            $lokasi = $value['lokasi' . $index];
        }

        $builder = $this->KinerjaModel->deleteAll('dokumen', $data);
        $path = str_replace(' ', '', '/var/www/ciapp3/public' . $lokasi);
        unlink($path);
        return redirect()->to(base_url('/kinerja'));
    }

    public function downloadFile()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $params = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'id_dk'         => $value['id_dk' . $index]
            ];
            $lokasi = $value['lokasi' . $index];
        }
        $query = $this->KinerjaModel->getAll('dokumen', $params);
        $dokumen = $query->getRow();
        // dd($query->getRow());
        return $this->response->download('../public' . trim($dokumen->lokasi), null)->setFileName(trim($dokumen->dokumen));
    }

    //fungsi submit 
    public function setStatus()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $index = $value['index'];
            $params = [
                'tahun_pengukuran'         => $this->tahun,
                'sistem_pengukuran'        => $this->sistem,
                'iku'           => $value['iku' . $index],
                'id_pengguna'   => $value['id' . $index],
            ];
            $status['status'] = $value['status' . $index];
        }
        $builder = $this->KinerjaModel->updateAll('pengukuran', $params, $status);
        return redirect()->to(base_url('/kinerja'));
    }
}
