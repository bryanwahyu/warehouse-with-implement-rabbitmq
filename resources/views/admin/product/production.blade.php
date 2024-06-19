@extends('layout.admin')
@section('isi')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('datatable.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('datatable.min.css')}}">
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="btn-group">
            <button onclick="add_modal()" class="btn-primary btn">Tambah</button>
        </div>
    </div>
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body">
                <table id="table">
                    <thead>
                        <th>Product</th>
                        <th>jumlah</th>
                        <th>nama</th>
                        <th>tanggal jadi</th>
                        <th>status</th>
                        <th>action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form class="form-horizontal " onsubmit="return addproduction();">
                <div class="form-group form-row">
                    <label  class="col-2">Product</label>
                    <div class="col-8">
                        <select id="add-product"></select>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label  class="col-2">PIC</label>
                    <div class="col-8">
                        <input type="text" id="add-nama" class="form-control">
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-2">jumlah</label>
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

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form class="form-horizontal " onsubmit="return editproduction();">
                <div  id="form-produksi" class="form-group form-row">
                    <input type="hidden" id="id">
                    <input type="hidden" id="status">
                    <label  class="col-2">Product</label>
                    <div class="col-8">
                        <select id="edit-product"></select>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label  class="col-2">PIC</label>
                    <div class="col-8">
                        <input type="text" id="edit-nama" class="form-control">
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-2">jumlah</label>
                    <div class="col-8">
                        <input type="number" id="edit-jumlah" class="form-control">
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-2">Tanggal :</label>
                    <div class="col-8">
                        <input type="date"  id="edit-tanggal" class="form-control">
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

<script>
    let table=$("#table").DataTable()

    $.ajax({
        method:"GET",
        url:`${api}/v1/production?with=product`,
        headers:{
            Authorization :`Bearer ${localStorage.getItem('token')}`
        },
        success:res=>{
            console.log(res);
            res.data.forEach(item => {
                let action=''
                if(item.status=='menyiapkan'){
                    action=`
                    <div class="btn-group">
                            <button class="btn btn-success" onclick="change(${item.id},'Proses')">Proses</button>
                            <button class="btn btn-primary" onclick="edit_modal(${item.id})">Edit</button>
                            <button class="btn btn-danger" onclick="hapus(${item.id})">Hapus</button>
                    </div>`
                }
                if(item.status=="Proses"){
                    action=`
                    <div class="btn-group">
                            <button class="btn btn-danger" onclick="change(${item.id},'fail')">gagal</button>
                            <button class="btn btn-primary" onclick="edit_modal(${item.id})">Berhasil</button>
                    </div>`
                }

                table.row.add([
                    item.product.name,
                    item.jumlah,
                    item.nama,
                    item.tanggal_selesai,
                    item.status,
                    action
                ]).draw(false)
             });
                }
        });

        function add_modal(){
            $("#add-modal").modal('show')
            $("#add-product").select2({
            ajax:{
                url:`${api}/v1/product`,
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
        function  addproduction(){
            let data={}
            data.product_id=$("#add-product").val()
            data.jumlah=$("#add-jumlah").val()
            data.nama=$("#add-nama").val()
            $.ajax({
                method:"POST",
                url:`${api}/v1/production`,
                headers:{
                    Authorization:`Bearer ${localStorage.getItem('token')}`
                },
                contentType:"application/json",
                data:JSON.stringify(data),
                success:res=>{
                    alert("Data Produksi berhasil")
                    window.location.reload()
                },
                error:res=>{
                    let error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                    }else {
                        alert("hubungin backend")
                    }
                }
            })
            return false
        }
    function edit_modal(id){
        $("#id").val(id)
        let product=$("#edit-product").select2({
            ajax:{
                url:`${api}/v1/product`,
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

        $.ajax({
            method:"GET",
            url:`${api}/v1/production/${id}?load=product`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                console.log(res)
                let options = new Option(res.data.product.name, res.data.product_id, true, true)
                  product.append(options).trigger('change')
                  product.trigger({
                     type: 'select2:select',
                     params:
                    {
                        data: res.data.product_id
                    }
                })
                $('#status').val(res.data.status)
                $('#edit-nama').val(res.data.nama)
                $('#edit-jumlah').val(res.data.jumlah)
                $("#edit-tanggal").val(res.data.tanggal_selesai)

                $("#form-product").removeClass('-none')
                if(res.data.status!="menyiapkan"){
                    $("#form-product").addClass('d-none')
              }
            }
        })
        $("#edit-modal").modal('show')
    }
    function hapus(id){
        $.ajax({
            method:"DELETE",
            url:`${api}/v1/production/${id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                alert('data produksi berhasil dihapus')
                window.location.reload()
            },
            error:res=>{
                    let error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                    }else {
                        alert("hubungin backend")
                    }
                }
        })
    }
    function change(id,status){
        $.ajax({
            method:"Patch",
            url:`${api}/v1/production/${id}/${status}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                alert('berhasil mengubah status');
                window.location.reload()
            },
            error:res=>{
                let error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                    }else {
                        alert("hubungin backend")
                    }
            }
        })
    }

    function editproduction(){
        let status=$("#status").val()
        let id=$("#id").val()
        let data={}
        data.name=$("#edit-nama").val()
        data.jumlah=$("#edit-jumlah").val()
        data.tanggal_selesai=$('#edit-tanggal').val()
        if(status=='menyiapkan'){
            $.ajax({
                method:"PUT",
                url:`${api}/v1/production/${id}`,
                headers:{
                    Authorization:`Bearer ${localStorage.getItem('token')}`
                },
                contentType:'application/json',
                data:JSON.stringify(data),
                success:res=>{
                    alert('berhasil ganti data')
                    window.location.reload()
                }, error:res=>{
                let error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                    }else {
                        alert("hubungin backend")
                    }
                }
            })
        }
        else {
            $.ajax({
                method:"put",
                url:`${api}/v1/production/${id}/check`,
                headers:{
                    Authorization:`Bearer ${localStorage.getItem('token')}`
                },
                contentType:'application/json',
                data:JSON.stringify(data),
                success:res=>{
                    alert('berhasil diproduksi')
                    window.location.reload()
                },
                error:res=>{
                    let error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                    }else {
                        alert("hubungin backend")
                    }
                }
            })
        }
        return false
    }
</script>
@endsection
