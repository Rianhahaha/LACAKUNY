<?php

namespace App\Controllers;

use App\Models\BaseModel;
use App\Models\SimprokaModel;
use App\Models\UsersModel;
use CodeIgniter\I18n\Time;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Simproka1 extends BaseController
{
    private $session = null;

    //konstraktor
    public function __construct()
    {
        $this->uri = helper('url');
        $this->BaseModel = new BaseModel();
        $this->SimprokaModel = new SimprokaModel();
        $this->UsersModel = new UsersModel();
        $this->session = session();
        $this->id_pengguna = $this->session->get('id_pengguna');
        $this->ket_pengguna = $this->session->get('ket_pengguna');
        $this->tahun = $this->session->get('tahun');
        $this->sistem = $this->session->get('sistem');
        $this->detail = $this->session->get('detail');
        $this->data = $this->session->get('data');
        $this->kode = $this->session->get('kode');
        $this->params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->sistem
        ];
    }
    public function edit()
    {
        // dd($this->data);
        return view('simproka/simprokaEdit', $this->data);
    }

    public function setDate()
    {
        $data = $this->request->getPost();

        //membuat input untuk database guna membuka simproka
        $tanggal = explode("-", $data['tanggal_buka']);
        $waktu = explode(":", $data['waktu_buka']);

        $date = Time::create($tanggal[0], $tanggal[1], $tanggal[2], $waktu[0], $waktu[1], 0, 'Asia/Jakarta', 'en_US');
        $dataIn = [
            'kegiatan'  => 'simproka_open',
            'indikator' => json_encode([
                'tahun' => $this->tahun,
                'sistem' => $this->sistem
            ]),
            'tanggal'   => $date
        ];
        $params = [
            'kegiatan'  => 'simproka_open',
            'indikator' => json_encode([
                'tahun' => $this->tahun,
                'sistem' => $this->sistem
            ])
        ];
        //check kondisi jika data ada maka insert, jika tidak maka update
        $isExist = $this->BaseModel->getAll('deadline', $params)->getResultArray();
        if (empty($isExist)) {
            $this->BaseModel->insertAll('deadline', $dataIn);
        } else {
            $this->BaseModel->updateAll('deadline', $params, $dataIn);
        }

        //membuat input untuk database guna membuka simproka
        $tanggal = explode("-", $data['tanggal_tutup']);
        $waktu = explode(":", $data['waktu_tutup']);

        $date = Time::create($tanggal[0], $tanggal[1], $tanggal[2], $waktu[0], $waktu[1], 0, 'Asia/Jakarta', 'en_US');
        $dataIn = [
            'kegiatan'  => 'simproka_close',
            'indikator' => json_encode([
                'tahun' => $this->tahun,
                'sistem' => $this->sistem
            ]),
            'tanggal'   => $date
        ];
        $paramsClose = [
            'kegiatan'  => 'simproka_close',
            'indikator' => json_encode([
                'tahun' => $this->tahun,
                'sistem' => $this->sistem
            ])
        ];
        //check kondisi jika data ada maka insert, jika tidak maka update
        if (empty($isExist)) {
            $this->BaseModel->insertAll('deadline', $dataIn);
        } else {
            $this->BaseModel->updateAll('deadline', $paramsClose, $dataIn);
        }
        return redirect()->to(base_url('/simproka1'))->withInput();
    }
    public function formInput()
    {
        $data = $this->kode;

        $dataEdit = [];
        if (isset($data)) {
            $dataEdit = $this->SimprokaModel->dataEdit($this->params, $data);
        }
        $dataEdit['sistem'] = $this->bulan;
        $dataEdit['tahun'] = $this->tahun;
        $dataEdit['file'] = [];

        $dataEdit['totalFile'] = [];
        $dataEdit['bagian'] = 'KRO';
        $dataEdit['kode'] = dot_array_search('0.kro', $data);
        $dataEdit['ket_pengguna'] = $this->ket_pengguna;

        $this->session->set('data', $dataEdit);
        return view('simproka/simprokaFormInput', $dataEdit);
    }
    public function formEdit()
    {
        $data = $this->kode;
        // dd($data);
        $dataEdit = [];
        if (isset($data)) {
            $dataEdit = $this->SimprokaModel->dataEdit($this->params, $data);
        }
        $dataEdit['sistem'] = $this->bulan;
        $dataEdit['tahun'] = $this->tahun;
        $dataEdit['kode'] = 0;
        $dataEdit['file'] = [];
        $dataEdit['akhir'] = 0;

        $dataEdit['totalFile'] = [];
        $dataEdit['bagian'] = 'KRO';
        $dataEdit['kode'] = dot_array_search('0.kro', $data);
        $dataEdit['ket_pengguna'] = $this->ket_pengguna;
        $this->session->set('data', $dataEdit);
        return view('simproka/simprokaFormEdit', $dataEdit);
    }
    public function formRegistrasi()
    {
        $data[] = $this->request->getPost();
        $id_pengguna = $this->UsersModel->getLastID();

        $dataReg = [
            'id_pengguna'   => $id_pengguna + 1,
            'email'         => dot_array_search('0.email', $data),
            'password'      => sha1(dot_array_search('0.password', $data)),
            'keterangan'    => dot_array_search('0.keterangan', $data),
            'tampilan'      => strtoupper(dot_array_search('0.keterangan', $data)),
            'status'        => dot_array_search('0.status', $data),
            'online'        => 0
        ];
        $this->BaseModel->insertAll('pengguna', $dataReg);
        return redirect()->to(base_url('/beranda'));
    }
    public function formEditAdmin()
    {
        $data[] = $this->request->getPost();
        // dd($data, $this->kode);
        $dataEdit = [];
        if (null != (dot_array_search('0.id_pengguna', $data))) {
        }
        if (null != (dot_array_search('0.uraian', $data))) {
        }
        if (null != (dot_array_search('0.newKode', $data))) {
            if (dot_array_search('0.newKode', $data) != dot_array_search('0.oldKode', $data)) {
                dd($data, $this->kode);
            }
        }
        // dd($this->request);
        return redirect()->to(base_url('/beranda'));
        // return redirect()->to(base_url('/simproka1Edit'))->withInput();
    }
    //fungsi mengubah session triwulan/sistem
    public function aksesData()
    {
        $sistem = intval($this->request->getPost('data'));
        $this->session->set('sistem', $sistem);
    }
    public function editPage()
    {
        $data[] = $this->request->getPost();
        // dd($data, $this->kode);
        $dataEdit = [];
        if (isset($data)) {
            $params = [
                'tahun'     => $this->tahun,
                'sistem'    => $this->bulan,
                'kode'      => dot_array_search('0.kode', $data)
            ];
            $this->session->set('kode', $data);
            if (dot_array_search('0.detail', $data) == 'KRO') {
                $query = $this->BaseModel->getAll('simproka', $params);

                $dataEdit['data'] = $query->getResultArray();
            } else if (dot_array_search('0.detail', $data) == 'RO') {
                $query = $this->BaseModel->getAll('ro', $params);

                $dataEdit['data'] = $query->getResultArray();
            } else if (dot_array_search('0.detail', $data) == 'KOMPONEN') {
                $query = $this->BaseModel->getAll('komponen', $params);

                $dataEdit['data'] = $query->getResultArray();
            } else if (dot_array_search('0.detail', $data) == 'SUBKOMPONEN') {
                $query = $this->BaseModel->getAll('subkomponen', $params);

                $dataEdit['data'] = $query->getResultArray();
            }
        }
        $dataEdit['select'] = dot_array_search('0.select', $data);
        $dataEdit['sistem'] = $this->bulan;
        $dataEdit['tahun'] = $this->tahun;
        $dataEdit['kode'] = 0;
        $dataEdit['file'] = [];
        $dataEdit['akhir'] = 0;

        $dataEdit['totalFile'] = [];
        $dataEdit['bagian'] = 'KRO';
        $dataEdit['kode'] = dot_array_search('0.kro', $data);
        $dataEdit['ket_pengguna'] = $this->ket_pengguna;
        $dataEdit['pic'] = $this->UsersModel->getPIC();
        $this->session->set('data', $dataEdit);
        return redirect()->to(base_url('/simproka1Edit'))->withInput();
    }

    public function dataGeneral()
    {
        $paramsSP = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->bulan,
            'id_pengguna' => $this->id_pengguna
        ];
        $sistemQuery = $this->BaseModel->getAll('sistem_simproka', $paramsSP);
        $dataSP = $sistemQuery->getResultArray();
        d($dataSP);
        $dataAll = [];
        foreach ($dataSP as $dsp => $value) {
            $paramsSubkomponen = [
                'tahun'     => $this->tahun,
                'sistem'    => $this->bulan,
                'kode' => $value['kode']
            ];
            $querySubkomponen = $this->BaseModel->getAll('subkomponen', $paramsSubkomponen);
            $dataSubkomponen = $querySubkomponen->getResultArray();
            foreach ($dataSubkomponen as $dsk => $value) {
                array_push($dataAll, $value);
            }
        }

        // tambahan
        $data['data'] = $dataAll;
        $data['sistem'] = $this->bulan;
        $data['tahun'] = $this->tahun;
        $data['kode'] = 0;
        $data['file'] = $this->file();
        $data['akhir'] = 0;

        $data['totalFile'] = $this->countFiles($sistemQuery->getResultArray());
        $data['bagian'] = 'RO';
        $data['sistem_pengguna'] = $dataSP;
        $data['ket_pengguna'] = $this->ket_pengguna;
        $this->session->set('data', $data);
        return $data;
    }

    public function setData($kro = true, $isiKRO = null)
    {
        $params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->bulan
        ];

        if ($kro) {
            $query = $this->BaseModel->getAllSort('simproka', $params, 'kode');

            $data['data'] = $query->getResultArray();
            $data['sistem'] = $this->bulan;
            $data['tahun'] = $this->tahun;
            $data['kode'] = 0;
            $data['akhir'] = 0;

            $data['totalFile'] = $this->countFiles($query->getResultArray());
            $data['file'] = $this->file();
            $data['bagian'] = 'KRO';
            $data['kode'] = 0;
            // $data['sistem_pengguna'] = $dataSP;
            $data['ket_pengguna'] = $this->ket_pengguna;
            $data['tanggal'] = $this->myTime->year . "-" . $this->myTime->month . "-" . $this->myTime->day;
        } else {
            if (isset($isiKRO)) {
                $kro = $isiKRO;
            }
            $paramsSP = [
                'tahun'     => $this->tahun,
                'sistem'    => $this->bulan,
                'id_pengguna' => $this->id_pengguna
            ];
            $sistemQuery = $this->BaseModel->getAll('sistem_simproka', $paramsSP);
            $dataSP = $sistemQuery->getResultArray();
            d($dataSP);
            foreach ($dataSP as $dsp => $value) {
                $kode = $value['kode'];
            }
            $params = [
                'tahun'     => $this->tahun,
                'sistem'    => $this->bulan
            ];
            $paramsRO = $params;
            $paramsRO['kro'] = $kro;
            $queryRO = $this->BaseModel->getAllSort('ro', $paramsRO, 'kode');
            $dataRO = $queryRO->getResultArray();

            $dataAll = [];
            $totalFiles = $this->countFiles($dataRO);
            foreach ($dataRO as $dr => $value) {
                $paramsKomponen = $params;
                $paramsKomponen['ro'] = $value['kode'];
                $queryKomponen = $this->BaseModel->getAllSort('komponen', $paramsKomponen, 'kode');
                $dataKomponen = $queryKomponen->getResultArray();
                array_push($dataAll, $value);
                $totalFiles = array_merge($totalFiles, $this->countFiles($dataKomponen));

                foreach ($dataKomponen as $DK => $valueDK) {
                    $paramsSubkomponen = $params;
                    $paramsSubkomponen['komponen'] = $valueDK['kode'];
                    $querySubkomponen = $this->BaseModel->getAllSort('subkomponen', $paramsSubkomponen, 'kode');
                    $dataSubkomponen = $querySubkomponen->getResultArray();
                    array_push($dataAll, $valueDK);
                    $totalFiles = array_merge($totalFiles, $this->countFiles($dataSubkomponen));

                    foreach ($dataSubkomponen as $DS => $valueDS) {
                        array_push($dataAll, $valueDS);
                    }
                }
            }
            $data['data'] = $dataAll;
            $data['sistem'] = $this->bulan;
            $data['tahun'] = $this->tahun;
            $data['kode'] = $kro;
            $data['file'] = $this->file();
            $data['akhir'] = 0;

            $data['totalFile'] = $totalFiles;
            $data['bagian'] = 'RO';
            $data['sistem_pengguna'] = $dataSP;
            $data['ket_pengguna'] = $this->ket_pengguna;
        }
        // dd($data);
        $this->session->set('data', $data);


        return $data;
    }
    public function file()
    {
        $params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->bulan
        ];
        $queryFile = $this->BaseModel->getAll('file_simproka', $params);
        return $queryFile->getResultArray();
    }
    public function KRO()
    {
        $this->session->set('sistem', $this->bulan);
        $this->setData();
        return redirect()->to(base_url('/simproka1'))->withInput();
    }
    public function RO($isi = null)
    {
        $this->session->set('sistem', $this->bulan);
        if (isset($isi)) {
            $kro = $isi;
        } else {
            $kro = $this->request->getPost('KRO');
        }
        $this->setData(false, $kro);
        return redirect()->to(base_url('/simproka1'))->withInput();
    }

    public function generalRedirect()
    {
        $this->session->set('sistem', $this->bulan);
        $query = $this->BaseModel->getAll('simproka', $this->params);
        $kro = $query->getResultArray();
        $firstLoop = true;
        $data = [];
        foreach ($kro as $kro => $value) {
            if ($firstLoop) {

                $data = $this->setData(false, trim($value['kode'], true));
                $firstLoop = false;
            } else {
                $dataPush = $this->setData(false, trim($value['kode'], true));
                for ($x = 0; $x < count($dataPush['data']); $x++) {
                    array_push($data['data'], dot_array_search('data.' . $x, $dataPush));
                }
                $totalFile = $dataPush['totalFile'];
                $temp = [];
                foreach ($totalFile as $dp => $value) {
                    $temp = array_merge($temp, array($dp => $value));
                    d($value, $dp, $temp);
                }
                $temp = array_merge($data['totalFile'], $temp);
                $data['totalFile'] = $temp;
            }
        }
        // dd($data);

        // tambah tambah
        // $data['sistem'] = $this->bulan;
        // $data['tahun'] = $this->tahun;
        // $data['kode'] = $kro;
        // $data['file'] = $this->file();
        // $data['akhir'] = 0;

        // $data['totalFile'] = 0;
        // $data['bagian'] = 'RO';
        // $data['sistem_pengguna'] = 0;
        // $data['ket_pengguna'] = $this->ket_pengguna;
        $this->session->set('data', $data);
        $this->dataGeneral();

        return redirect()->to(base_url('/simproka1'))->withInput();
    }

    //fungsi tampilan kinerja dengan data
    public function index()
    {
        d($this->data, $this->myTime->toDateTimeString(), $this->myTime->getTimestamp(), $this->myTime);
        return view('simproka/simproka1', $this->data);
    }

    public function countFiles($data = null)
    {
        $sumFiles[] = 0;
        $params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->bulan
        ];
        $simproka = $data;
        foreach ($simproka as $sp => $value) {
            $params['kode'] = trim($value['kode']);
            $total = $this->BaseModel->countAll('file_simproka', $params);
            $sumFiles[trim($value['kode'])] = $total;
        }
        return $sumFiles;
    }

    //fungsi untuk download template excel
    public function downloadFormat()
    {
        return $this->response->download('../public/uploads/file/Format_Simproka.xlsx', null);
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
        $query = $this->BaseModel->getIKK($paramsIKK);
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
            $activeSheet->getStyle('J' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('K' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('L' . $index)->applyFromArray($style_row_center);
            $activeSheet->getStyle('M' . $index)->applyFromArray($style_row_center);
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
        $activeSheet->getColumnDimension('J')->setWidth(11);
        $activeSheet->getColumnDimension('K')->setWidth(15);

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
            return  redirect()->to(base_url('/simproka1'))->withInput();
        }

        $fileExcel = $this->request->getFile('excel');
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan!'); //set pesan berhasil tambah data

        // looping untuk mengambil data
        $spreadsheet = IOFactory::load($fileExcel);
        $sheet =  $spreadsheet->getActiveSheet()->toArray(0, true, true, true);
        $indexLoop = 1;
        $oldSK;
        foreach ($sheet as $idx => $row) {
            //skip index sampai 5 tidak terpakai
            if (($idx <= 5) || (empty($row['C']))) {
                continue;
            }

            $dataSP = [
                'kode'          => $row['B'],
                'tahun'         => $this->tahun,
                'sistem'        => $this->bulan,
                'detail'       => '',
                'kode'         => '',
                'indikator'    => ''
            ];
            $dataPIC['tampilan'] = strtoupper($row['Q']);


            d($dataPIC['tampilan'], $dataPIC);
            if (!empty($row['Q'])) {
                $queryID = $this->BaseModel->getAll('pengguna', $dataPIC);
                $dataUser = $queryID->getResultArray();
                // dd($dataUser);


                if (!empty($dataUser)) {
                    foreach ($dataUser as $du => $value) {
                        $id = $value['id_pengguna'];
                    }
                    //data yang akan ditambahkan ke SISTEM PENGGUNA
                    $dataSP['id_pengguna'] = $id;
                }
            }

            if (!empty($row['C'])) {
                //menyimpan data excel ke $data yang akan dimasukkan ke db
                $data = [
                    'kode'              => $row['B'],
                    'uraian'            => $row['C'],
                    'satuan'            => $row['D'],
                    'volume_target'     => $row['E'],
                    'pic'               => $row['Q'],
                    'sistem'            => $this->bulan,
                    'tahun'             => $this->tahun,
                    'tanggal'           => strval($this->myTime->toDateTimeString() . ' WIB'),
                    'pengedit'          => $this->ket_pengguna
                ];
            }


            if (trim(strlen($row['B']) == 1)) {
                $data['detail'] = 'SUBKOMPONEN';
                $data['kode'] = $oldKode . '.' . $row['B'];
                $data['komponen'] = $oldKode;
                $data['status_validasi'] = 'pengisian';
                $this->BaseModel->insertAll('subkomponen', $data);
                $lastB = $row['B'];

                //baru
                if (isset($dataSP['id_pengguna'])) {
                    $dataSP['detail'] = "SUBKOMPONEN";
                    $dataSP['kode'] = $data['kode'];
                    $dataSP['indikator'] = $data['komponen'];
                    $this->BaseModel->insertAll('sistem_simproka', $dataSP);
                }
            } else {
                $oldKode = $row['B'];
                $data['detail'] = 'OTHER';
                //baru
                if (isset($dataSP['id_pengguna'])) {
                    $dataSP['detail'] = "OTHER";
                    $dataSP['kode'] = $data['kode'];
                    $dataSP['indikator'] = '';
                    $this->BaseModel->insertAll('sistem_simproka', $dataSP);
                }
            }
            $kode = explode('.', $row['B']);

            if (isset($kode[4])) {
                $data['detail'] = 'KOMPONEN';
                $data['ro'] = $kode[0] . '.' . $kode[1] . '.' . $kode[2] . '.' . $kode[3];
                $this->BaseModel->insertAll('komponen', $data);
                //baru
                if (isset($dataSP['id_pengguna'])) {

                    $dataSP['detail'] = "KOMPONEN";
                    $dataSP['kode'] = $data['kode'];
                    $dataSP['indikator'] = $data['ro'];
                    $this->BaseModel->insertAll('sistem_simproka', $dataSP);
                }
            } else if (isset($kode[3])) {
                $data['detail'] = 'RO';
                $data['kro'] = $kode[0] . '.' . $kode[1] . '.' . $kode[2];
                $this->BaseModel->insertAll('ro', $data);
                //baru
                if (isset($dataSP['id_pengguna'])) {

                    $dataSP['detail'] = "RO";
                    $dataSP['kode'] = $data['kode'];
                    $dataSP['indikator'] = $data['kro'];
                    $this->BaseModel->insertAll('sistem_simproka', $dataSP);
                }
            } else if (isset($kode[2])) {
                $data['detail'] = 'KRO';
                $this->BaseModel->insertAll('simproka', $data);
                //baru
                if (isset($dataSP['id_pengguna'])) {

                    $dataSP['detail'] = "KRO";
                    $dataSP['kode'] = $data['kode'];
                    $dataSP['indikator'] = $data['kode'];
                    $this->BaseModel->insertAll('sistem_simproka', $dataSP);
                }
            }

            // baru
            $dataSP['id_pengguna'] = 1230;
            $dataSP['detail'] = $data['detail'];
            $dataSP['kode'] = $data['kode'];
            if ($data['detail'] == 'KRO') {
                $dataSP['indikator'] = $data['kode'];
            } else if ($data['detail'] == 'RO') {
                $dataSP['indikator'] = $data['kro'];
            } else if ($data['detail'] == 'KOMPONEN') {
                $dataSP['indikator'] = $data['ro'];
            } else if ($data['detail'] == 'SUBKOMPONEN') {
                $dataSP['indikator'] = $data['komponen'];
            }
            $this->BaseModel->insertAll('sistem_simproka', $dataSP);

            $indexLoop++;
        }
        return redirect()->to(base_url('/KRO'));
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
            return  redirect()->to(base_url('/simproka1'))->withInput();
        }

        $params = [
            'tahun'     => $this->tahun,
            'sistem'    => $this->bulan
        ];
        if (sha1($password) == $user->password) {
            if ($hapusDokumen == "true") {
                $query = $this->BaseModel->getAll('file_simproka', $params);
                $files = $query->getResultArray();
                foreach ($files as $fl => $value) {
                    $lokasi = $value['lokasi'];
                    $path = str_replace(' ', '', '/var/www/ciapp3/public' . $lokasi);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $builder = $this->BaseModel->deleteAll('file_simproka', $params);
            }
            $this->BaseModel->deleteAll('simproka', $params);
            $this->BaseModel->deleteAll('ro', $params);
            $this->BaseModel->deleteAll('komponen', $params);
            $this->BaseModel->deleteAll('subkomponen', $params);
            $this->BaseModel->deleteAll('sistem_simproka', $params);
        }

        return redirect()->to(base_url('/KRO'));
    }


    //fungsi untuk edit isian table kinerja
    public function editSimproka()
    {
        $data[] = $this->request->getPost();

        // dd($data);
        foreach ($data as $dt => $value) {
            // dd($value['dok']);

            $bagianKRO = false;
            $bagianRO   = false;
            $params = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->sistem,
                'kode'           => $value['kode']
            ];
            if (!empty($value['kro'])) {
                $kro = $value['kro'];
            }
            $kode = $value['kode'];
            $detail = $value['detail'];
            $val['tanggal'] = strval($this->myTime->toDateTimeString() . ' WIB');
            $val['pengedit'] = $this->ket_pengguna;

            $val['kode'] = $value['kode'];
            if (!empty($value['newKode'])) {
                $val['kode'] = $value['newKode'];
            }
            if (!empty($value['uraian'])) {
                $val['uraian'] = $value['uraian'];
            }
            if (!empty($value['satuan'])) {
                $val['satuan'] = $value['satuan'];
            }
            if (!empty($value['volume_target'])) {
                $val['volume_target'] = $value['volume_target'];
            }
            if (!empty($value['capaian_volume'])) {
                $val['capaian_volume'] = $value['capaian_volume'];
            }
            if (!empty($value['progres'])) {
                $val['progres'] = $value['progres'];
            }
            if (!empty($value['capaian_rill'])) {
                $val['capaian_rill'] = $value['capaian_rill'];
            }
            if (!empty($value['satuan_rill'])) {
                $val['satuan_rill'] = $value['satuan_rill'];
            }
            if (!empty($value['status'])) {
                $val['status'] = $value['status'];
            }
            if (!empty($value['penjelasan'])) {
                $val['penjelasan'] = $value['penjelasan'];
            }
            if (!empty($value['kendala'])) {
                $val['kendala'] = $value['kendala'];
            }
            if (!empty($value['tindak_lanjut'])) {
                $val['tindak_lanjut'] = $value['tindak_lanjut'];
            }
            if (!empty($value['keterangan_kendala'])) {
                $val['keterangan_kendala'] = $value['keterangan_kendala'];
            }



            if (!empty($value['kodeSebelum'])) {
                $paramsZ = [
                    'tahun'         => $this->tahun,
                    'kode'          => $value['kodeSebelum']
                ];
                $valZ['status_validasi'] = 'belum mengajukan';
                $this->BaseModel->updateAll('simproka', $paramsZ, $valZ);
            }

            if (trim($value['detail']) == 'KRO') {
                $bagianKRO = true;
                $this->BaseModel->updateAll('simproka', $params, $val);
            } else if (trim($value['detail']) == 'RO') {
                $bagianRO = true;
                $this->BaseModel->updateAll('ro', $params, $val);
            } else if (trim($value['detail']) == 'KOMPONEN') {
                $this->BaseModel->updateAll('komponen', $params, $val);
            } else if (trim($value['detail']) == 'SUBKOMPONEN') {
                $this->BaseModel->updateAll('subkomponen', $params, $val);
            }
        }
        //store File
        if (null != $this->request->getFiles('dok[]')) {
            $docfile = $this->request->getFiles('dok[]');
            $dataDok = [[
                'kode' => $kode,
                'detail' => $detail,
                'dok' => $docfile
            ]];
            // dd($docfile);
            $this->saveFile($dataDok);
        }
        if ($bagianKRO == true) {
            return redirect()->to(base_url('/KRO'))->withInput();
        } else if (isset($kro)) {
            $data = $this->setData(false, $kro);
            return redirect()->to(base_url('/simproka1'))->withInput();
        } else {
            return redirect()->to(base_url('/general'))->withInput();
        }
    }
    //fungsi untuk hapus isian table kinerja
    public function deleteSimproka()
    {
        $data[] = $this->request->getPost();
        $bagianKRO = false;

        if (dot_array_search('0.detail', $data) == 'KRO') {
            $bagianKRO = true;
        }
        if (null != (dot_array_search('0.kro', $data))) {
            $kro = dot_array_search('0.kro', $data);
        }

        $result = $this->SimprokaModel->dataDelete($this->params, $data);
        // dd($result);

        if ($bagianKRO) {
            return redirect()->to(base_url('/KRO'))->withInput();
        } else {
            $data = $this->setData(false, $kro);
            return redirect()->to(base_url('/simproka1'))->withInput();
        }
    }

    //fungsi untuk edit isian table kinerja
    public function insertSimproka()
    {
        $data[] = $this->request->getPost();
        $bagianKRO = false;
        $bagianRO = false;
        // dd($data);
        foreach ($data as $dt => $value) {
            if (isset($value['kode4'])) {
                $value['kode'] = $value['kode3'] . '.' . $value['kode4'] . '.' . $value['kode5'];
                $kro = $value['kro'];
            } else if (isset($value['kode1'])) {
                $value['kode'] = $value['kode1'] . '.' . $value['kode2'];
                $kro = $value['kro'];
            }
            $val = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->bulan,
                'detail'        => $value['detail'],
                'kode'          => $value['kode'],
                'uraian'        => $value['uraian'],
                'satuan'        => $value['satuan'],
                'volume_target' => $value['volume_target']
            ];
            if ($value['detail'] == 'KRO') {
                $bagianKRO = true;
                $this->BaseModel->insertAll('simproka', $val);
            } else if ($value['detail'] == 'RO') {
                $bagianRO = true;
                $val['kro'] = $value['kode1'];
                $this->BaseModel->insertAll('ro', $val);
            } else if ($value['detail'] == 'KOMPONEN') {
                $val['ro'] = $value['kode1'];
                $this->BaseModel->insertAll('komponen', $val);
            } else if ($value['detail'] == 'SUBKOMPONEN') {
                $val['komponen'] = $value['kode3'] . '.' . $value['kode4'];
                $val['status_validasi'] = 'pengisian';
                $this->BaseModel->insertAll('subkomponen', $val);
            }
        }
        if ($bagianKRO == true) {
            return redirect()->to(base_url('/KRO'))->withInput();
        } else if ($bagianRO == true) {
            $data = $this->setData(false, $kro);
            return redirect()->to(base_url('/simproka1'))->withInput();
        } else {
            return redirect()->to(base_url('/general'))->withInput();
        }
    }


    //fungsi menyimpan foto multiple
    public function storeMultipleImage()
    {
        $data[] = $this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('foto');

        // if (!$input) {
        //     return  redirect()->to(base_url('/simproka1'))->withInput();
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
                        $save = $this->BaseModel->insertAll('foto', $data);
                    }
                }
            }
        }

        return redirect()->to(base_url('/simproka1'))->withInput();
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

        $builder = $this->BaseModel->deleteAll('foto', $params);
        $path = str_replace(' ', '', '/var/www/ciapp3/public' . $lokasi);
        unlink($path); //menghapus file dari penyimpanan
        return redirect()->to(base_url('/simproka1'));
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
        $query = $this->BaseModel->getAll('foto', $params);
        $foto = $query->getRow();
        // dd($query->getRow());
        return $this->response->download('../public' . trim($foto->lokasi), null)->setFileName(trim($foto->foto));
    }

    public function saveFile($data)
    {
        // dd($data);
        foreach ($data as $dt => $value) {
            $kode = $value['kode'];
        }
        if (null != $value['dok']) {
            $docfile = $value['dok'];
            foreach ($docfile as $df) {
                foreach ($df as $doc => $file) {
                    if ($file->isValid() && !($file->hasMoved())) {

                        $newName = $file->getRandomName();
                        $path = '/uploads/file';
                        $file->store('../../public' . $path, $newName);
                        $data = [
                            'file' =>  $file->getClientName(),
                            'kode' => $kode,
                            'lokasi' => $path . '/' . $newName,
                            'tahun' => $this->tahun,
                            'sistem' => $this->bulan
                        ];
                        $save = $this->BaseModel->insertAll('file_simproka', $data);
                    }
                }
            }
        }
        return $kode;
    }
    //fungsi menyimpan dokumen multiple
    public function storeMultipleFile()
    {
        $data[] = $this->request->getPost();
        $db      = \Config\Database::connect();
        $builder = $db->table('file_simproka');
        // dd($data);
        $detail = 0;
        foreach ($data as $dt => $value) {
            $detail = $value['detail'];
            $kode = $value['kode'];
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
                            'file' =>  $file->getClientName(),
                            'kode' => $kode,
                            'lokasi' => $path . '/' . $newName,
                            'tahun' => $this->tahun,
                            'sistem' => $this->bulan
                        ];
                        $save = $this->BaseModel->insertAll('file_simproka', $data);
                    }
                }
            }
        }
        if (trim($detail) == "KRO") {
            $this->setData();
            return redirect()->to(base_url('/KRO'))->withInput();
        } else if (trim($detail) == "RO") {
            return redirect()->to(base_url('/RO'))->withInput();
        } else {
            return redirect()->to(base_url('/general'))->withInput();
        }
    }

    //fungsi delete dokumen
    public function deleteDokumen()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $data = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->bulan,
                'id_file'       => $value['id_file'],
                'kode'          => $value['kode'],
                'file'          => $value['file']
            ];
            $detail = $value['detail'];
            $lokasi = $value['lokasi'];
        }

        $builder = $this->BaseModel->deleteAll('file_simproka', $data);
        $path = str_replace(' ', '', '/var/www/ciapp3/public' . $lokasi);
        if (file_exists($path)) {
            unlink($path);
        }
        if (trim($detail) == "KRO") {
            $this->setData();
            return redirect()->to(base_url('/KRO'))->withInput();
        } else if (trim($detail) == "RO") {
            return redirect()->to(base_url('/RO'))->withInput();
        } else {
            return redirect()->to(base_url('/general'))->withInput();
        }
    }

    public function downloadFile()
    {
        $data[] = $this->request->getPost();
        foreach ($data as $dt => $value) {
            $params = [
                'tahun'         => $this->tahun,
                'sistem'        => $this->bulan,
                'id_file'         => $value['id_file']
            ];
            $lokasi = $value['lokasi'];
        }
        $query = $this->BaseModel->getAll('file_simproka', $params);
        $file = $query->getRow();
        return $this->response->download('../public' . trim($file->lokasi), null)->setFileName(trim($file->file));
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
        $builder = $this->BaseModel->updateAll('pengukuran', $params, $status);
        return redirect()->to(base_url('/simproka1'));
    }
}
