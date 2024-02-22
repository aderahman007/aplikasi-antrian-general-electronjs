<script type="text/javascript">
    var idInterval = false;

    function extractword(str, start, end) {
        let string = str.substring(
            str.indexOf(start) + 1,
            str.lastIndexOf(end)
        );
        return string;
    }

    const getAntrian = () => {
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
                    if (result.data.length > 0) {
                        $.each(result.data, function(index, value) {
                            $("#antrian-" + value.code_antrian).html(`${value.code_antrian}${value.no_antrian}`).fadeIn('slow')
                        });
                    } else {
                        $("[id^='antrian']").html('');
                    }
                }
            }
        });
    }

    $(document).ready(function() {
        // tampilkan jumlah antrian
        getAntrian();

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
                        <span class="spinner-grow spinner-grow-sm my-2" role="status" aria-hidden="true"></span>
                    `);

                    clearInterval(idInterval);
                },
                success: function(result) {
                    if (result.success == true) {
                        getAntrian();
                    } else {
                        alert('Eits ada masalah nih, hubungi IT Support yaa!');
                    }
                },
                error: function(data) {
                    var loadExtractData = '{' + extractword(data.responseText, '{', '}') + '}';
                    var loadExtractDataParse = JSON.parse(loadExtractData);
                    if (loadExtractDataParse.success == true) {
                        getAntrian();
                        alert(`Antrian anda ${loadExtractDataParse.data.code_antrian}${loadExtractDataParse.data.no_antrian} berhasil diambil, tapi printer bermasalah!`);
                    }
                },
                complete: function(data) {
                    tombolAmbil.removeClass("disabled");
                    tombolAmbil.html(`<i class="bi-person-plus fs-4 me-2"></i> AMBIL`);

                    startInterval();
                }
            });
        });

        const startInterval = () => {
            idInterval = setInterval(() => {
                getAntrian();
            }, 1000);
        }

        startInterval();
    });
</script>