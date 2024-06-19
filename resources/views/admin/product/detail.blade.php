@extends('layout.admin')
@section('isi')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('datatable.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('datatable.min.css')}}">
@endsection
@section('content')
<input type="hidden" value="{{$id}}" id="id">
<div class="row">
    <div class=" col-12">
        <div class="card">
            <div class="card-header" id="nama-product">

            </div>
            <div class="card-body">
                <span class="col-2">SKU :</span>
                <span id="sku-product"></span>

                <span class="col-2">Data Stok  Saat ini :</span>
                <span id="stok-product"></span>
                <span class="col-2">Category :</span>
                <span id="category-product"></span>
                <span class="col-2">Harga :</span>
                <span id="harga-product"></span>
                <span class="col-2">Lama Proses</span>
                <span id="lama-proses-product"></span>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" onclick="edit_modal()">Edit Data</button>
                <button class="btn btn-success d-none" onclick="import_modal()">import Excel</button>
            </div>
        </div>
    </div>
    <div class="col-12 my-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Resep
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <button class="btn btn-primary" onclick="add_resep_modal()">Tambah Bahan</button>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <table id="tabel-resep">
                            <thead>
                                <th>Bahan</th>
                                <th>Takaran</th>
                                <th>Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 my-4">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Masuk
                    </div>
                    <div class="card-body">
                        <div class="col-12 mb-2">
                            <button class="btn btn-primary" onclick="add_masuk_modal()">tambah data masuk</button>
                        </div>
                        <div class="col-12 table-responsive">
                            <table id="tabel-masuk">
                                <thead>
                                  <th>Nama</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Jumlah</th>
                                  <th>Action</th>
                              </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">Keluar</div>
                    <div class="card-body">
                        <div class="col-12 mb-2">
                            <button class="btn btn-danger" onclick="add_keluar_modal()">tambah data keluar</button>
                        </div>
                        <div class="col-12 table-responsive">
                            <table id="tabel-keluar">
                                <thead>
                                  <th>Nama</th>
                                  <th>Tanggal</th>
                                  <th>Keterangan</th>
                                  <th>Jumlah</th>
                                  <th>Action</th>
                              </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="import-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Import </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="col-12 mb-3">
                    <button class="btn btn-secondary" onclick="template()">
                        Template
                    </button>
            </div>
            <form class="form-horizontal " onsubmit="return import_excel();">
                <div class="form-horizontal form-group">
                    <label  class="col-2">File</label>
                    <div class="col-8">
                        <input type="file" id="import" class="form-control">
                    </div>
                </div>
            </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
        </div>
      </div>
    </div>
  </div>


<div class="modal fade" id="add-keluar-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="test">data keluar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal " onsubmit="return add_keluar();">
                <div class=" form-row form-group">
                    <label class="col-2">PIC</label>
                    <div class="col-8">
                        <input type="text" id="add-nama-keluar" class="form-control">
                    </div>
                </div>
                <div class="form-row form-group">
                    <label class="col-2">jumlah</label>
                    <div class="col-8">
                        <input type="number"  id="add-jumlah-keluar" class="form-control">
                    </div>
                </div>
                <div class="form-row form-group">
                    <label class="col-2">Keterangan</label>
                    <div class="col-8">
                        <input type="text" class="form-control" id="add-keterangan-keluar">
                    </div>
                </div>
            </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
        </div>
    </div>
    </div>
  </div>

<div class="modal fade" id="add-masuk-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="test">data masuk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal " onsubmit="return add_masuk();">
                <div class=" form-row form-group">
                    <label class="col-2">PIC</label>
                    <div class="col-8">
                        <input type="text" id="add-nama-masuk" class="form-control">
                    </div>
                </div>
                <div class="form-row form-group">
                    <label class="col-2">jumlah</label>
                    <div class="col-8">
                        <input type="number"  id="add-jumlah-masuk" class="form-control">
                    </div>
                </div>
                <div class="form-row form-group">
                    <label class="col-2">Keterangan</label>
                    <div class="col-8">
                        <input type="text" class="form-control" id="add-keterangan-masuk">
                    </div>
                </div>
            </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
        </div>
    </div>
    </div>
  </div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bahan">SKU</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal " onsubmit="return editproduct();">
                <div class="form-group">
                    <label  class="col-2">SKU</label>
                    <div class="col-8">
                        <input type="text" id="edit-sku" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-2">Nama</label>
                    <div class="col-8">
                        <input type="text" id="edit-name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-2">Category</label>
                    <div class="col-8">
                        <select id="edit-category" class="form-control"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-2">Satuan</label>
                    <div class="col-8">
                        <select id="edit-satuan" class="form-control"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-2">Harga</label>
                    <div class="col-8">
                        <input type="number" id="edit-harga" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-2">Lama Proses (hitungan hari)</label>
                    <div class="col-8">
                        <input type="number" id="edit-lama-proses" class="form-control">
                    </div>
                </div>

            </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="add-recipe-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bahan">Recipe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal " onsubmit="return addrecipe();">
                <div class="form-group">
                    <label  class="col-2">Bahan</label>
                    <div class="col-8">
                        <select class="form-control" id="add-bahan-id"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-2">Jumlah</label>
                    <div class="col-8">
                        <input type="number" id="add-jumlah" class="form-control">
                    </div>
                </div>
            </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit-recipe-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="bahan">Recipe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal " onsubmit="return editresep();">
                <div class="form-group">
                    <label  class="col-2">Bahan</label>
                    <div class="col-8">
                        <select class="form-control" id="edit-bahan-id"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label  class="col-2">Jumlah</label>
                    <div class="col-8">
                        <input type="number" id="edit-jumlah" class="form-control">
                    </div>
                </div>
                <input type="hidden" id="id-resep">
            </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
         </form>
        </div>
    </div>
  </div>
</div>

<script>
    let id=$("#id").val()
    function import_modal(){
        $("#import-modal").modal('show')
    }
    function import_excel(){
        let data=new FormData()
        data.append('file', $('#import')[0].files[0]);

        $.ajax({
            method:"POST",
            url:`${api}/v1/import/masuk-keluar/${id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            data: data,
            contentType: false,
            processData: false,
            success:res=>{
                alert("import sukses");
                window.location.reload()
            },
            error:res=>{
                 let error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                    }else{
                        alert("hubungin backend")
                    }
            }
        })
        return false
    }

    function template(){
        $.ajax({
            method:"get",
            url:`${api}/v1/export/excel/masuk-keluar`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            responseType: 'arraybuffer', // Set the response type to 'arraybuffer'
            success:res=>{
                let blob = new Blob([res], { type: 'text/csv' });

                // Create a data URL representing the Blob
                var blobUrl = URL.createObjectURL(blob);


                // Create a temporary link element
                var link = document.createElement('a');
                link.href = blobUrl;
                link.download = 'masukkeluar.csv';

                // Append the link to the body and simulate a click

                document.body.appendChild(link);
                link.click();

                // Clean up: remove the link and revoke the Blob URL
                 document.body.removeChild(link);
                URL.revokeObjectURL(blobUrl);
            },
             error:res=>{
                 let error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                    }else{
                        alert("hubungin backend")
                    }
            }
        })

    }
    function hapusresep(id){
        $.ajax({
            method:"delete",
            url:`${api}/v1/recipe/${id}`,
        headers:{
            Authorization:`Bearer ${localStorage.getItem('token')}`,
            Accept:'application/json'
        },
        success:res=>{
            alert('data resep berhasil dihapus')
            window.location.reload()
        },
        error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
    }
    function edit_resep_modal(id_res){
        $('#id-resep').val(id_res)
        $.ajax({
            method:"get",
            url:`${api}/v1/recipe/${id_res}?load=bahan`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`,
                Accept:'application/json'
            },
            success:res=>{

          let bahan = $("#edit-bahan-id").select2(
          {
            ajax:
            {
              url: `${api}/v1/bahan`,
              headers:
              {
                Authorization: `Bearer ${localStorage.getItem('token')}`
              },
              processResults: function(res)
              {
                let items = []
                res.data.forEach(e =>
                {
                  let item = {}
                  item.id = e.id
                  item.text = e.name + ' ' + e.sku
                  items.push(item)
                });
                return {
                  results: items
                }
              }
            }
          })
          let options = new Option(res.data.bahan.name, res.data.bahan_id, true, true)
          bahan.append(options).trigger('change')
          bahan.trigger(
          {
                type: 'select2:select',
                params:
                {
                    data: res.data.bahan.id
                }
              })
              $('#edit-jumlah').val(res.data.jumlah)
            }
        });
        $('#edit-recipe-modal').modal('show')
    }
    function editresep(){
        let id=$('#id-resep').val()
        let data={}
        data.bahan_id=$("#edit-bahan-id").val()
        data.jumlah=$('#edit-jumlah').val()
         $.ajax({
            method:"put",
            url:api+`/v1/recipe/${id}`,
            contentType:"application/json",
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            data:JSON.stringify(data),
            success:res=>{
                alert("data resep  berhasil ditambahkan")
                window.location.reload()
            },
            error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
        return false;
    }
    let resep=$("#tabel-resep").DataTable()
    $.ajax({
        mehtod:"GET",
        url:`${api}/v1/recipe?with=bahan.satuan&product_id=${id}`,
        headers:{
            Authorization:`Bearer ${localStorage.getItem('token')}`,
            Accept:'application/json'
        },
        success:res=>{
            res.data.forEach(item=>{
                let action=`<div class="btn-group">
                                <button class="btn btn-primary" onclick='edit_resep_modal(${item.id})'>edit</button>
                                <button class="btn btn-warning" onclick='hapusresep(${item.id})'>hapus</button>
                            </div>`
                resep.row.add([
                item.bahan.name,
                item.jumlah+' '+item.bahan.satuan.name,
                action
                ]).draw(false)
            })
        }
    })
    $.ajax({
        method:"GET",
        url:api+`/v1/product/${id}?with=category,satuan`,
        headers:{
            Authorization:`Bearer ${localStorage.getItem('token')}`
        },
        success:res=>{
            $('#nama-product').text(res.data.name)
            $('#sku-product').text(res.data.sku)
            $("#stok-product").text(`${res.data.stok} ${res.data.satuan.name}`)
            $('#category-product').text(res.data.category.name)
            $("#harga-product").text(res.data.harga)
            $('#lama-proses-product').text(`${res.data.time_product} hari`)

        }
        })
        function edit_modal(){
            $.ajax({
                method:"get",
                url:api+"/v1/product-category?select=yes",
            headers:{
                Authorization :"Bearer "+localStorage.getItem('token')
            },
            success:res=>{
                    $('#edit-category').html(res.data)
                }
            })
            $.ajax({
                method:"get",
                url:api+"/v1/product-satuan?select=yes",
            headers:{
                Authorization :"Bearer "+localStorage.getItem('token')
            },
            success:res=>{
                    $('#edit-satuan').html(res.data)
                }
            })
            $('#edit-modal').modal('show')
            $.ajax({
                  method:"GET",
                  url:api+`/v1/product/${id}`,
                  headers:{
                        Authorization:`Bearer ${localStorage.getItem('token')}`
                },
            success:res=>{
                    $('#edit-name').val(res.data.name)
                    $('#edit-sku').val(res.data.sku)
                    $('#edit-category').val(res.data.category_product_id)
                    $('#edit-satuan').val(res.data.satuan_product_id)
                    $("#edit-harga").val(res.data.harga)
                    $("#edit-lama-proses").val(res.data.time_product)
                }
        })
    }
    $.ajax({
        method:"GET",
        url:`${api}/v1/product-masuk?product_id=${id}`,
        headers:{
            Authorization:`Bearer ${localStorage.getItem('token')}`
        },
        success:res=>{
            res.data.forEach(item => {
                let action=`
                    <div class="btn-group">
                        <button class="btn btn-danger" onclick="hapus_masuk(${item.id})">Hapus</button>
                    </div>`
                masuk.row.add([
                    item.nama,
                    new Date(item.created_at).toLocaleString(),
                    item.keterangan,
                    item.jumlah,
                    action
                ]).draw(false)
            });
        }
    })

    function add_masuk(){
        let data={}
        data.product_id=id
        data.nama=$("#add-nama-masuk").val()
        data.jumlah=$("#add-jumlah-masuk").val()
        data.keterangan=$("#add-keterangan-masuk").val()
        $.ajax({
            method:"POST",
            url:`${api}/v1/product-masuk`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            data:JSON.stringify(data),
            contentType:"application/json",
            success:res=>{
                alert("Data Masuk berhasil ditambahkan")
                window.location.reload()
            },
            error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
        return false
    }
    function add_keluar(){
        let data={}
        data.product_id=id
        data.nama=$("#add-nama-keluar").val()
        data.jumlah=$("#add-jumlah-keluar").val()
        data.keterangan=$("#add-keterangan-keluar").val()
        $.ajax({
            method:"POST",
            url:`${api}/v1/product-keluar`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            data:JSON.stringify(data),
            contentType:"application/json",
            success:res=>{
                alert("Data Keluar berhasil ditambahkan")
                window.location.reload()
            },
            error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
        return false
    }
    function hapus_masuk(id){
        console.log(id)
        $.ajax({
            method:"DELETE",
            url:`${api}/v1/product-masuk/${id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                alert("berhasil menghapus masuk")
                window.location.reload()
            },
            error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
    }
    function hapus_keluar(id){
        $.ajax({
            method:"DELETE",
            url:`${api}/v1/product-keluar/${id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                alert("berhasil menghapus keluar")
                window.location.reload()
            },
            error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
    }

    $.ajax({
        method:"GET",
        url:`${api}/v1/product-keluar?product_id=${id}`,
        headers:{
            Authorization:`Bearer ${localStorage.getItem('token')}`
        },
        success:res=>{
            res.data.forEach(item => {
                let action=`
                    <div class="btn-group">
                        <button class="btn btn-danger" onclick="hapus_keluar(${item.id})">Hapus</button>
                    </div>`
                keluar.row.add([
                    item.nama,
                    new Date(item.created_at).toLocaleString(),
                    item.keterangan,
                    item.jumlah,
                    action
                ]).draw(false)
                })
        }
    })

    function editproduct(){
        let data={}
        data.name=$("#edit-name").val()
        data.sku=$('#edit-sku').val()
        data.satuan_product_id=$("#edit-satuan").val()
        data.category_product_id=$('#edit-category').val()
        data.harga=$("#edit-harga").val()
        data.time_product=$("#edit-lama-proses").val()
        $.ajax({
            method:"PUT",
            url:api+`/v1/product/${id}`,
            contentType:"application/json",
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            data:JSON.stringify(data),
            success:res=>{
                alert("data product berhasil di edit")
                window.location.reload()
            },
            error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
        return false
    }
    function add_resep_modal(){
        $('#add-recipe-modal').modal('show')
        $("#add-bahan-id").select2({
            ajax:{
                url:`${api}/v1/bahan`,
                headers:{
                        Authorization:`Bearer ${localStorage.getItem('token')}`
                    },
                processResults:function(res){
                    console.log(res.data)
                    let items=[]
                    res.data.forEach(e => {
                        let item={}
                        item.id=e.id
                        item.text=e.name+' '+e.sku

                        items.push(item)
                    });
                    return {
                        results:items
                    }
                }
            }
        })

    }
    function addrecipe(){
        let data={}
        data.product_id=id
        data.bahan_id=$("#add-bahan-id").val()
        data.jumlah=$("#add-jumlah").val()
        $.ajax({
            method:"POST",
            url:api+`/v1/recipe`,
            contentType:"application/json",
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            data:JSON.stringify(data),
            success:res=>{
                alert("data resep  berhasil ditambahkan")
                window.location.reload()
            },
            error:res=>{
            let error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
        return false
    }

    function add_masuk_modal(){
        $('#add-masuk-modal').modal('show')
    }
    function add_keluar_modal(){
        $("#add-keluar-modal").modal('show')
    }


    let keluar=$("#tabel-keluar").DataTable()

    let masuk=$("#tabel-masuk").DataTable()
</script>
@endsection
