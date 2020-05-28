<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar php ajax autocomplete</title>
        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        #resultlist {
            position: absolute;
            width: 85%;
            max-width: 92%;
            cursor: pointer;
            overflow-y: auto;
            max-height: 550px;
            box-sizing: border-box;
            z-index: 10010;
        }
        .link-class:hover {
            background-color: yellow;
            cursor: pointer;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1 align="center"><b>belajar php ajax (Pendaftaran siswa baru)</b></h1>
        <h2 align="center" class="mb-4 mt-4"><b>Autocomplete Dengan Gambar</b></h2>
        <div align="center">
            <input type="text" id="nama_siswa" placeholder="Pencarian Nama Siswa Baru...." class="form-control" />
        </div>
        <ul class="list-group" id="resultlist"></ul>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                cache: false
            });
            $('#nama_siswa').keyup(function() {
                $('#resultlist').html('');
                $('#state').val('');
                let nama_siswa = $('#nama_siswa').val();
                $.ajax({
                    type: 'POST',
                    url: "get_data pencarian.php",
                    data: {
                        nama_siswa: nama_siswa
                    },
                    success: function(data) {
                        $.each(JSON.parse(data), function(key, value) {
                            $('#resultlist').append(`
                  <li class="list-group-item link-class">
                    <img src="gambar/` + value.gambar + `" height="40" width="40" class="img-thumbnail" /> 
                    <span class="nama">` + value.nama_siswa + `</span>
                    <span class="text-muted" style="float: right;">` + value.alamat + `</span>
                  </li>`);
                        });
                    }
                });
            });
            $('#resultlist').on('click', 'li', function() {
                let nama_siswa = $(this).children('.nama').text();
                $('#nama_siswa').val(nama_siswa);
                $("#resultlist").html('');
            });
        });
    </script>
</body>
</html>
