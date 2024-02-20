<script type="text/javascript">
    function extractword(str, start, end) {
        let string = str.substring(
            str.indexOf(start) + 1,
            str.lastIndexOf(end)
        );
        return string;
    }
    $(document).ready(function() {
        // tampilkan jumlah antrian
        $.ajax({
            url: 'pages/nomor/action.php',
            method: 'POST',
            data: {
                type: 'get_antrian'
            },
            async: false,
            cache: false,
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {
                    if (result.data != null) {
                        $.each(result.data, function(index, value) {
                            $("#antrian-" + value.code_antrian).html(`${value.code_antrian}${value.no_antrian}`).fadeIn('slow')
                        });
                    }
                }
            }
        })

        $(document).delegate("a[id^='insert']", "click", function(e) {
            var tombolAmbil = $(this);
            let code_antrian = tombolAmbil.data('code_antrian');

            $.ajax({
                url: 'pages/nomor/action.php',
                type: 'POST',
                data: {
                    type: 'create_antrian',
                    code_antrian: code_antrian
                },
                dataType: 'json',
                beforeSend: function(data) {
                    tombolAmbil.addClass("disabled");
                    tombolAmbil.html(`
                        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                        <small> Loading...</small>
                    `);
                },
                success: function(result) {
                    if (result.success == true) {
                        $.ajax({
                            url: 'pages/nomor/action.php',
                            method: 'POST',
                            data: {
                                type: 'get_antrian'
                            },
                            async: false,
                            cache: false,
                            dataType: 'json',
                            success: function(result) {
                                $.each(result.data, function(index, value) {
                                    $("#antrian-" + value.code_antrian).html(`${value.code_antrian}${value.no_antrian}`).fadeIn('slow')
                                });
                            }
                        });
                    } else {
                        alert('Eits ada masalah nih, hubungi IT Support yaa!');
                    }
                },
                error: function(data) {
                    var loadExtractData = '{' + extractword(data.responseText, '{', '}') + '}';
                    var loadExtractDataParse = JSON.parse(loadExtractData);
                    if (loadExtractDataParse.success == true) {
                        $.ajax({
                            url: 'pages/nomor/action.php',
                            method: 'POST',
                            data: {
                                type: 'get_antrian'
                            },
                            async: false,
                            cache: false,
                            dataType: 'json',
                            success: function(result) {
                                $.each(result.data, function(index, value) {
                                    $("#antrian-" + value.code_antrian).html(`${value.code_antrian}${value.no_antrian}`).fadeIn('slow')
                                });
                                alert(`Antrian anda ${loadExtractDataParse.data.code_antrian}${loadExtractDataParse.data.no_antrian} berhasil diambil, tapi printer bermasalah!`);
                            }
                        });
                    }
                },
                complete: function(data) {
                    tombolAmbil.removeClass("disabled");
                    tombolAmbil.html(`<i class="bi-person-plus fs-4 me-2"></i> Ambil`);
                }
            });
        });

    });
</script>