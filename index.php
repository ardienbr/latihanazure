<html>
 <head>
 <Title>Kontak Kami</Title>
 <style type="text/css">
 	body { background-color: #fff; border-top: solid 10px #000;
 	    color: #333; font-size: .85em; margin: 20; padding: 20;
 	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 	}
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
 <h1>Kontak Kami</h1>
 <p>Silahkan tinggalkan komentar anda dibawah ini</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Nama  <input type="text" name="nama" id="nama"/></br></br>
       Email <input type="text" name="email" id="email"/></br></br>
       Komentar <input type="text" name="komentar" id="komentar"/></br></br>
       <input type="submit" name="submit" value="Submit" />
       <input type="submit" name="tampil_data" value="Tampil Data" />
 </form>
 <?php
    $host = "latihanazurewebapp.database.windows.net";
    $user = "ardien";
    $pass = "@stembase71";
    $db = "latihanazure";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

    if (isset($_POST['submit'])) {
        try {
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $komentar = $_POST['komentar'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Kontak (nama, email, komentar, date) 
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $nama);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $komentar);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        echo "<h3>Komentar Anda Telah Ditambahkan!</h3>";
    } else if (isset($_POST['tampil_data'])) {
        try {
            $sql_select = "SELECT * FROM Kontak";
            $stmt = $conn->query($sql_select);
            $komentaranda = $stmt->fetchAll(); 
            if(count($komentaranda) > 0) {
                echo "<h2>Daftar Komentar Anda:</h2>";
                echo "<table>";
                echo "<tr><th>Nama</th>";
                echo "<th>Email</th>";
                echo "<th>Komentar</th>";
                echo "<th>Date</th></tr>";
                foreach($komentaranda as $komentaranda) {
                    echo "<tr><td>".$komentaranda['nama']."</td>";
                    echo "<td>".$komentaranda['email']."</td>";
                    echo "<td>".$komentaranda['komentar']."</td>";
                    echo "<td>".$komentaranda['date']."</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<h3>Belum ada komentar ditambahkan.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>
