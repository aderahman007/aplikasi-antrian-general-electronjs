<?php
// Mengatasi CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header('Access-Control-Allow-Methods: GET, POST');
header("Allow: GET, POST");
// pengecekan ajax request untuk mencegah direct access file, agar file tidak bisa diakses secara langsung dari browser
// panggil file "database.php" untuk koneksi ke database
require_once "../../config/query.php";
// jika ada ajax request
if (isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET')) {
    if (isset($_POST)) {
        $action = new config\query;
        $payload = json_decode(file_get_contents("php://input"), true);

        if (isset($payload['type'])) {
            if ($payload['type'] == 'test_koneksi_server') {
                echo json_encode([
                    'success' => true,
                    'message' => 'Success',
                    'data' => 'Server connected!'
                ]);
            }

            if ($payload['type'] == 'get_antrian_printer') {
                $query = $action->getAntrianPrinter();

                $dataAntrianPrinters = array();

                // Ambil hasil query dan masukkan ke dalam array
                while ($row = mysqli_fetch_assoc($query)) {
                    $dataAntrianPrinters[] = array(
                        'id' => $row['id'],
                        'no_antrian' => $row['no_antrian'],
                        'code_antrian' => $row['code_antrian']
                    );
                }

                $querySetting = $action->getSetting();
                // ambil jumlah baris data hasil query
                $rows = mysqli_num_rows($querySetting);

                if ($rows <> 0) {
                    $config = mysqli_fetch_assoc($querySetting);
                } else {
                    $config = [];
                }

                echo json_encode([
                    'success' => true,
                    'message' => 'Success',
                    'data' => [
                        'antrian' => $dataAntrianPrinters,
                        'config' => $config
                    ]
                ]);
            }

            if ($payload['type'] == 'delete_antrian_printer') {
                $id = $payload['id'];
                $query = $action->deleteAntrianPrinter($id);

                if ($query) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Delete Success on id ' . $id
                    ]);
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Error'
                    ]);
                }
            }
        }
    }
}
