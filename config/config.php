<?php 
session_start();
// Database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'penjualan';
$conn = mysqli_connect($host, $user, $password, $dbname);


// query
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Jumlah Data
function rows($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    return $rows;
}

// Data Produk
function tambahProduk($data)
{
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $price = $data["price"];
    $unit = 1;
    $category = $data["category"];
    $stock = $data["stock"];
    $descriptions = $data["descriptions"];

    $query = "INSERT INTO products
                VALUES
                ('', '$name', '$unit', '$price', '$descriptions', '$category', '$stock')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateProduk($data)
{
    global $conn;

    $id = $data["id"];
    $name = htmlspecialchars($data["name"]);
    $price = $data["price"];
    $category = $data["category"];
    $stock = $data["stock"];
    $descriptions = $data["descriptions"];

    $query = "UPDATE products SET
                product_name = '$name',
                price = '$price',
                descriptions = '$descriptions',
                category_id = '$category',
                stock = '$stock'
                WHERE id_product = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusProduk($id) 
{
    global $conn;

    mysqli_query($conn, "DELETE FROM products WHERE id_product = $id");
    return mysqli_affected_rows($conn);

}

// Data Gallery

function tambahGaleri($data)
{
    global $conn;
    $name = $data["name"];
    $photo = upload();
    if (!$photo) {
        return false;
    }

    $query = "INSERT INTO products_galleries
                VALUES
                ('', '$photo', '$name')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateGaleri($data)
{
    global $conn;

    $id = $data["id"];
    $name = $data["name"];
    $photoLama = $data["photoLama"];
    if ($_FILES['photo']['error'] === 4) {
        $photo = $photoLama;
    } else {
        $photo = upload();
        if (!$photo) {
            return false;
        }
    }

    $query = "UPDATE products_galleries SET
                photos = '$photo',
                product_id = '$name'
                WHERE id_gallery = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusGallery($id) 
{
    global $conn;

    mysqli_query($conn, "DELETE FROM products_galleries WHERE id_gallery = $id");
    return mysqli_affected_rows($conn);

}

// Category

function tambahCategory($data)
{
    global $conn;
    $name = $data["name"];
    $slug = slug($name);

    $query = "INSERT INTO categories
                VALUES
                ('', '$name', '$slug')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateCategory($data)
{
    global $conn;

    $id = $data["id"];
    $name = $data["name"];
    $slug = slug($name);

    $query = "UPDATE categories SET
                category_name = '$name',
                slug = '$slug'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusCategories($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM categories WHERE id = $id");
    return mysqli_affected_rows($conn);
}

// Users

function tambahUser($data)
{
    global $conn;
    $name = $data["name"];
    $email = stripslashes($data["email"]);
    $phone_number = $data["phone_number"];
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $alamat = $data["alamat"];
    $code = $data["code"];
    $roles = $data["roles"];

    $query = "INSERT INTO users
                VALUES
                ('', '$name', '$email', '$password', '$alamat', '$phone_number', '$code', '$roles')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateUser($data)
{
    global $conn;
    $id = $data["id"];
    $result = query("SELECT password FROM users WHERE id_user = $id")[0];
    $name = $data["name"];
    $phone_number = $data["phone_number"];
    if (empty($data["password"])) {
        $password = $result["password"];
    } else {
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
    }
    $alamat = $data["alamat"];
    $code = $data["code"];
    $roles = $data["roles"];

    $query = "UPDATE users SET
                name = '$name',
                password = '$password',
                address = '$alamat',
                phone_number = '$phone_number',
                postal_code = '$code',
                roles = '$roles'
                WHERE id_user = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);   
}

function hapusUser($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");
    return mysqli_affected_rows($conn);
}

// Register

function register($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $email = stripslashes($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $number = $data["telpon"];

    $result = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
    if (mysqli_fetch_assoc($result)) {
        $_SESSION["error"] = "Email Sudah Tersedia!";
        return false;
    }

    if ($password !== $password2) {
        $_SESSION["error"] = "Konfirmasi Password Tidak Sesuai";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users
                VALUES
                ('', '$nama', '$email', '$password', null, '$number', '', 'USER')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// Add To cart
function addToCart($data) 
{
    global $conn;
    $product_id = $data["product_id"];
    $user_id = $data["user_id"];
    $banyak = $data["banyak"];

    $product = query("SELECT * FROM products WHERE id_product = $product_id")[0];
    $stock = $product["stock"];
    $unit = $product["unit"];
    $sisaBarang = $stock - ($banyak * $unit);

    if ($sisaBarang < 0) {
        echo "<script>
                alert('Stock Barang Tidak Cukup');
            </script>";
        return false;
    }

    $total = $banyak * $product["price"];

    $queryCart = "INSERT INTO carts
                VALUES
                ('', '$user_id', '$product_id', '$banyak', '$total')
            ";
    
    mysqli_query($conn, $queryCart);

    $stockProduk =  $product["stock"] - ($banyak * 1);

    $queryProduct = "UPDATE products SET
                        stock = '$stockProduk'
                    WHERE id_product = $product_id
                    ";
    mysqli_query($conn, $queryProduct);
    return mysqli_affected_rows($conn);

}

// Delete Product at cart

function deleteProductAtCart($data)
{
    global $conn;
    $idProduct = $data["deleteProduct"];

    mysqli_query($conn, "DELETE FROM carts WHERE id_cart = $idProduct");
    return mysqli_affected_rows($conn);
}

// checkout

function checkout($data)
{
    global $conn;

    $code = "EZM-";
    $user_id = $data['user_id'];
    $total_price = $data["total_price"];
    if ($total_price == 0) {
        echo "<script>
                alert('Pilih Produk Terlebih dahulu');
            </script>";
        return false;
    }
    $city = $data["city"];
    if (!isset($data["alamat"])) {
        $address = $data["address"];
    }else {
        $address = $data["alamat"];
    }

    if (empty($address)) {
        echo "<script>
                alert('Masukkan Alamat Terlebih dahulu');
            </script>";
        return false;
    }

    $phone_number = $data["phone_number"];
    $zip_code = $data["zip_code"];
    $rekening = $data["rekening"];
    $status = "BELUM KONFIRMASI";
    $weight = $data["weight"];
    $delivered = isset($data["delivered"] ) ? $data["delivered"] : 0;
    $photo = "";
    $code .= mt_rand(00000, 99999);

    $queryUser = "UPDATE users SET
                    phone_number = '$phone_number',
                    postal_code = '$zip_code',
                    address = '$address'
                    WHERE id_user = $user_id
                ";
    mysqli_query($conn, $queryUser);

    $queryTransaction = "INSERT INTO transactions
                            VALUES
                            ('', '$user_id', '$total_price', '$city', '$rekening', '$status', '$weight', '$delivered', '$photo', '$code', '', NULL, NOW())
                        ";
    mysqli_query($conn, $queryTransaction);
    
    $carts = query("SELECT * FROM carts INNER JOIN products ON carts.product_id = products.id_product WHERE user_id = $user_id");
    $codeProduct = 'PRD-';
    $dataIdTransaction = query("SELECT * FROM transactions");
    $codeProduct .= mt_rand(00000,99999);
    
    foreach ($carts as $cart) {
        foreach ($dataIdTransaction as $idTransaction) {
            $transaction_id = $idTransaction["id_transaction"];
        }
        $id_product = $cart["product_id"];
        
        $productPrice = $cart["price"];
        $banyak = $cart["banyak"];
        $queryTransactionDetails = "INSERT INTO transactions_details
                                VALUES
                            ('', '$transaction_id', '$id_product', '$user_id', '$productPrice', '$banyak', '$codeProduct')
                            ";
        mysqli_query($conn, $queryTransactionDetails);
    }

    mysqli_query($conn, "DELETE FROM carts WHERE user_id = $user_id");

    return mysqli_affected_rows($conn);

}

// transfer
function uploadTransfer($data)
{
    global $conn;

    $id = $data["id_transaction"];
    $photo = upload();
    if (!$photo) {
        return false;
    }

    $query = "UPDATE transactions SET
                photo_transaction = '$photo'
                WHERE id_transaction = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function konfirmasi($data)
{
    global $conn;

    $id = $data["id_transaction"];
    $status = "TERKONFIRMASI";

    $query = "UPDATE transactions SET
                transaction_status = '$status'
                WHERE id_transaction = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusTransaction($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM transactions WHERE id_transaction = $id");
    return mysqli_affected_rows($conn);
}

// driver

function tambahDriver($data)
{
    global $conn;
    $name = $data["name"];
    $email = stripslashes($data["email"]);
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $phone_number = $data["phone_number"];
    $noPegawai = $data["noPegawai"];
    $jurusan = $data["jurusan"];

    $query = "INSERT INTO drivers
                VALUES
                ('', '$name', '$email', '$password', '$phone_number', '$jurusan', '$noPegawai')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateDriver($data)
{
    global $conn;
    $id = $data["id"];
    $result = query("SELECT password FROM drivers WHERE id_driver = $id")[0];
    $name = $data["name"];
    $phone_number = $data["phone_number"];
    if (empty($data["password"])) {
        $password = $result["password"];
    } else {
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
    }
    $noPegawai = $data["noPegawai"];

    $query = "UPDATE drivers SET
                name_driver = '$name',
                password = '$password',
                phone_number = '$phone_number',
                no_pegawai = '$noPegawai'
                WHERE id_driver = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusDriver($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM drivers WHERE id_driver = $id");
    return mysqli_affected_rows($conn);
}

// customer

function tambahCustomer($data)
{
    global $conn;
    $name = $data["nama_customer"];
    $email = stripslashes($data["email"]);
    $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $phone_number = $data["phone_number"];
    $alamat = $data["alamat"];

    $query = "INSERT INTO customers
                VALUES
                ('', '$nama_customer', '$email', '$password', '$phone_number', '$alamat')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateCustomer($data)
{
    global $conn;
    $id = $data["id"];
    $result = query("SELECT password FROM customers WHERE id_customer = $id")[0];
    $name = $data["nama_customer"];
    $phone_number = $data["phone_number"];
    if (empty($data["password"])) {
        $password = $result["password"];
    } else {
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
    }

    $query = "UPDATE customers SET
                nama_customer = '$name',
                password = '$password',
                phone_number = '$phone_number',
                WHERE id_customer = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusCustomer($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM customers WHERE id_customer = $id");
    return mysqli_affected_rows($conn);
}


// pickup
function pickup($data)
{
    global $conn;

    $id_transaction = $data["id_transaction"];
    date_default_timezone_set('Asia/jakarta');
    $tambah3Jam = time() + 60 * 60 * 3;
    $arrive = date('Y-m-d H:i:s', $tambah3Jam);

    $query = "UPDATE transactions SET
                transaction_status = 'PICKUP',
                time_arrived = '$arrive'
                WHERE id_transaction = $id_transaction
            ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function terkirim($data)
{
    global $conn;

    $id_transaction = $data["id_transaction"];
    $penerima = $data["penerima"];

    $query = "UPDATE transactions SET
                transaction_status = 'TERKIRIM',
                receiver = '$penerima',
                time_arrived = NOW()
                WHERE id_transaction = $id_transaction
            ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// Rekening
function tambahRekening($data)
{
    global $conn;
    $bank_name = $data["bank_name"];
    $no_rekening = stripslashes($data["no_rekening"]);
    $pemilik = $data["pemilik"];

    $query = "INSERT INTO rekening_numbers
                VALUES
                ('', '$bank_name', '$no_rekening', '$pemilik')
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function updateRekening($data)
{
    global $conn;
    $id = $data["id"];
    $bank_name = $data["bank_name"];
    $no_rekening = $data["no_rekening"];
    $pemilik = $data["pemilik"];

    $query = "UPDATE rekening_numbers SET
                bank_name = '$bank_name',
                number = '$no_rekening',
                rekening_name = '$pemilik'
                WHERE id_rekening = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn); 
}

function hapusRekening($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM rekening_numbers WHERE id_rekening = $id");
    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['photo']["name"];
    $size = $_FILES['photo']["size"];
    $error = $_FILES['photo']["error"];
    $tmpName = $_FILES['photo']["tmp_name"];

    if ($error === 4) {
        echo "<script>
            alert('Pilih Gambar Terlebih dahulu');
          </script>";
        return false;
    }

    $ekstensiGambarValid = ['png', 'jpg', 'jpeg'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                    alert('format gambar Harus (png, jpg atau jpeg)');
                </script>";
        return false;
    }

    if ($size > 10000000) {
        echo "<script>
                    alert('Ukuran file gambar harus < 10 Mb');
                </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, '../assets/images/' . $namaFileBaru);
    return $namaFileBaru;

}

function slug($text) 
{
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    $text = preg_replace('~[^-\w]+~', '', $text);

    $text = trim($text, '-');

    $text = preg_replace('~-+~', '-', $text);

    $text = strtolower($text);

    return $text;
}

?>