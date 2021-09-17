<tr>
    <td class="content">
        <h1>INTERNAL MEMO</h1>
        <hr>
        <table class="description">
            <tr>
                <td>Tanggal</td>
                <td><?= date("Y-m-d"); ?></td>
            </tr>
            <tr>
                <td>Nomor Order</td>
                <td>(otomatis)</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td><?= $_SESSION['kduser'] ?></td>
            </tr>
            <tr>
                <td>Nama Pemohon</td>
                <td><?= $_SESSION['nmuser'] ?></td>
            </tr>
            <tr>
                <td>Departemen</td>
                <td><?= $_SESSION['nmdept'] ?></td>
            </tr>
            
            <tr style="display:none">
                <td>KD ITEM</td>
                <td><input type="text" id="kditem"></td>
            </tr>
            
            <tr>
                <td>Keterangan</td>
                <td><textarea name="" id="ket"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" id="submit" value="Simpan"> <button style="display:none" id="itemupdate">//DEV UPDATE ITEM</button></td>
            </tr>
        </table>
        <h1>DETAIL INTERNAL MEMO</h1>
        <hr>
        <table class="detail">
            <tr>
                <td><input type="text" id="kode_item" placeholder="Kode item"></td>
                <td><input type="text" id="keterangan" placeholder="Keterangan"></td>
                <td><button id="searchitem">Search</button></td>
            </tr>
        </table>

        <table class="result" id="div1">
        </table>
        <hr>
        <table class="detail">
            <tr>
                <td>KODE</td>
                <td>KETERANGAN</td>
                <td></td>
            </tr>
        </table>
        <table class="result" id="div2">
        </table>
    </td>
</tr>
<script src="<?= base_url('assets/') ?>jquery.min.js"></script>
<script>
    window.onload = function(){
        document.getElementById("searchitem").click();
    }

    $(document).ready(function(){
        $("#searchitem").click(function(){
            $("#div1").load("http://[::1]/iom/index.php/iom/ajax_item?kode_item=" + $("#kode_item").val() + "&keterangan=" + $("#keterangan").val() + "&item=" + $("#kditem").val(), function(responseTxt, statusTxt, xhr){
            });
            document.getElementById("itemupdate").click();
        });
        $("#itemupdate").click(function(){
            $("#div2").load("http://[::1]/iom/index.php/iom/ajax_item_show?kode_item=" + $("#kditem").val(), function(responseTxt, statusTxt, xhr){
            });
        });
        $("#submit").click(function(){
            if($("#kditem").val() == ""){
                alert('Belum ada item.');
                return false;
            }
            var temp = $("#kditem").val();
            var item = temp.slice(0, -1);
            //alert("http://[::1]/iom/index.php/iom/item_insert?item=" + item + "&ket=" + $("#ket").val());
            $(location).attr('href', "http://[::1]/iom/index.php/iom/item_insert?item=" + item + "&ket=" + $("#ket").val())
        });
    });
    
    function add_item(kd){
        document.getElementById("kditem").value += kd + ",";
        document.getElementById("searchitem").click();
    }

    function remove_item(kd){
        var item = document.getElementById("kditem").value;
        var replacement = item.replace(kd, "");
        
        document.getElementById("kditem").value = replacement;
        document.getElementById("searchitem").click();
    }
</script>