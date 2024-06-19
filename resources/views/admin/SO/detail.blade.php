@extends('layout.admin')

@section('isi')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('datatable.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('datatable.min.css')}}">
@endsection
@section('content')
<input type="hidden" id="id" value="{{$id}}">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Daftar SO</div>
            <div class="card-body">
                <div class="col-12 my-3">
                    <div class="form-group form-row">
                        <label class="col-3">Customer</label>
                        <div class="col-8">
                            <select id="customer-so" onchange="customer_data()" class="form-control"></select>
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label class="col-3">P.I.C </label>
                        <div class="col-8">
                            <input type="text" id="name-so" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label  class="col-3">Tanggal di kirim </label>
                        <div class="col-8">
                            <input type="date" id="tanggal-kirim" class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label class="col-3">Shipper</label>
                        <div class="col-8">
                            <input type="text" class="form-control" id="shipper-so" value="Lalamove">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label  class="col-3">Alamat</label>
                        <div class="col-8">
                        <textarea id="alamat-so" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <h1>list item </h1>
                    <div class="col-12 my-3">
                        <button class="btn btn-primary" id="tambah" onclick="show_modal()">Tambah</button>
                    </div>
                    <div class="col-12 table-responsive" >
                        <table id="table">
                            <thead>
                                <th>Product</th>
                                <th>jumlah pesanan</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group form-row">
                        <label class="col-3">Discount</label>
                        <div class="col-8">
                            <label for="type-discount" class="col-2">Persentase</label><input type="radio" name="type-discount" id="type-discount" onchange="type_discounted()" value="persen">
                            <label for="type-discount" class="col-2">Nominal</label><input type="radio" name="type-discount" id="type-discount" onchange="type_discounted()" value="nominal">
                        </div>
                        <div class="col-12">
                            <input type="text" class="d-none form-control" value="0" onchange="discount_SO()" id="discount-so">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label class="col-2">Ongkos pengiriman</label>
                        <div class="col-8">
                            <input type="text" class="form-control"  onchange="delivery_costfile()" id="delivery-cost">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label  class="col-2">Sub-Total</label>
                        <div class="col-8">
                            <input type="text" id="sub-total" readonly class="form-control">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <label class="col-2">Tax Cost</label>
                        <div class="col-8">
                            <input type="text"  id="tax-cost" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label for="discount" class="col-2">Discount</label>
                    <div class="col-8">
                        <input type="text" readonly class="form-control" id="price-discount" value="0">
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-2">GrandTotal</label>
                    <div class="col-8">
                        <input type="text"  id="total-cost" readonly class="form-control">
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" onclick="sendToServer(false)">Simpan</button>
                </div>
             </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Pesanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal " onsubmit="return edit_pesanan();">
                <div class="form-group form-row">
                    <input type="hidden" id="id-det">
                    <label  class="col-2">Product</label>
                    <div class="col-8">
                        <select id="edit-product-id" class="form-control" onchange="checkEditPrice()"></select>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-2"> Order</label>
                    <div class="col-3">
                        <input type="text" id="edit-jumlah-pesanan" class="form-control">
                    </div>
                    <label class="col-2">harga</label>
                    <div class="col-3">
                        <input type="text" id="edit-harga" class="form-control">
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
<div class="modal fade" id="tambah-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Pesanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal " onsubmit="return add_pesanan();">
                <div class="form-group form-row">
                    <label  class="col-2">Product</label>
                    <div class="col-8">
                        <select id="add-product-id" class="form-control" onchange="checkPrice()"></select>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-2"> Order</label>
                    <div class="col-3">
                        <input type="text" id="add-jumlah-pesanan" class="form-control">
                    </div>
                    <label class="col-2">harga</label>
                    <div class="col-3">
                        <input type="text" id="add-harga" class="form-control">
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
    function show_modal(){
        $('#tambah-modal').modal('show')
    }
let edit={}
    function show_edit(id_det){
        $ ("#id-det").val(id_det)
        $.ajax({
            method:"get",
            url:`${api}/v1/detail-sales-order/${id_det}?load=product`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem("token")}`,
            },
            success:res=>{
                edit=res.data 
          let product=$("#edit-product-id").select2({
            ajax:{
                url:`${api}/v1/product`,
                headers:{
                        Authorization:`Bearer ${localStorage.getItem('token')}`
                    },
                processResults:function(res){
                    let items=[]
                    res.data.forEach(e => {
                        let item={}
                        item.id=e.id
                        item.text=e.name
                        items.push(item)
                    });
                    return {
                        results:items
                    }
                 }
                }
            })
          let options = new Option(res.data.product.name, res.data.product.id, true, true)
            product.append(options).trigger('change')
            product.trigger(
          {
            type: 'select2:select',
            params:
            {
              data: res.data.product.id
            }
             })
                $("#edit-harga").val(res.data.price)
                $("#edit-jumlah-pesanan").val(res.data.jumlah)
            }
        })
        $("#edit-modal").modal('show')
    }
    let customer_id=''
    let id=$("#id").val()
    let table=$("#table").DataTable()
    let discount=0
    let tax_cost=0
    let delivery_cost=0
    let total_cost=0
    let sub_total=0
    let type=""
    let payment=''
    let status=''

    function discount_SO(){
        if(type=="persen"){
            discount=sub_total*($('#discount-so').val()/100);
        }
        if(type=="nominal"){
            discount=$('#discount-so').val()
        }
        tax_cost=(sub_total-discount)*10/100
        total_cost=sub_total-discount+delivery_cost+tax_cost;
        $("#price-discount").val(discount)
        $("#total-cost").val(total_cost)
        $("#sub-total").val(sub_total)
        $("#tax-cost").val(tax_cost)
    }
    function edit_pesanan(){
        let id_det=$("#id-det").val()
        sub_total=sub_total-(edit.price*edit.jumlah)

        let data={}
        data.product_id=$("#edit-product-id").val()
        data.price=$('#edit-harga').val()
        data.jumlah=$('#edit-jumlah-pesanan').val()
        
        $.ajax({
            method:"PUT",
            url:`${api}/v1/detail-sales-order/${id_det}`,
            data:JSON.stringify(data),
            contentType:"application/json",
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`,
                Accept:'application/json'
            },
            success:res=>{
                sub_total=sub_total+(res.data.price*res.data.jumlah)
                if(type=="persen"){
                    discount=sub_total*($('#discount-so').val()/100)
                }
                if(type=="nominal"){
                    discount=$('#discount-so').val()
                }
                tax_cost=(sub_total-discount)*10/100;
                total_cost= sub_total-discount+delivery_cost+tax_cost;
                $("#price-discount").val(discount)
                $("#total-cost").val(total_cost)
                $("#tax-cost").val(tax_cost)
                $("#sub-total").val(sub_total)
                sendToServer(true)
            },
            error:res=>{
                let  error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        });
        return false
    }
    function add_pesanan(){
        let data={}
        data.sales_order_id=id
        data.product_id=$("#add-product-id").val()
        data.price=$('#add-harga').val()
        data.jumlah=$('#add-jumlah-pesanan').val()
        $.ajax({
            method:"POST",
            url:`${api}/v1/detail-sales-order`,
            data:JSON.stringify(data),
            contentType:"application/json",
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`,
                Accept:'application/json'
            },
            success:res=>{
                sub_total=sub_total+(res.data.price*res.data.jumlah)
                if(type=="persen"){
                    discount=sub_total*($('#discount-so').val()/100)
                }
                if(type=="nominal"){
                    discount=$('#discount-so').val()
                }
                tax_cost=(sub_total-discount)*10/100;
                total_cost= sub_total-discount+delivery_cost+tax_cost;
                $("#price-discount").val(discount)
                $("#total-cost").val(total_cost)
                $("#tax-cost").val(tax_cost)
                $("#sub-total").val(sub_total)
                sendToServer(true)
            },
            error:res=>{
                let  error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        });
        return false;
    }   
     function delivery_costfile(){
        delivery_cost =parseFloat($("#delivery-cost").val())
        tax_cost=(sub_total-discount)*10/100
        total_cost=sub_total-discount+delivery_cost+tax_cost;
        $("#tax-cost").val(tax_cost)
        $("#total-cost").val(total_cost)

    }
    $.ajax({
        method:'get',
        url:`${api}/v1/sales-order/${id}?load=detail.product,customer`,
        headers:{
            Authorization:`Bearer ${ localStorage.getItem('token') }`
        },
        success:res=>{
          let customer=$("#customer-so").select2({
            ajax:{
                url:`${api}/v1/customer`,
                headers:{
                        Authorization:`Bearer ${localStorage.getItem('token')}`
                    },
                processResults:function(res){
                    let items=[]
                    res.data.forEach(e => {
                        let item={}
                        item.id=e.id
                        item.text=e.name
                        items.push(item)
                    });
                    return {
                        results:items
                    }
                 }
                }
            })
          let options = new Option(res.data.customer.name, res.data.customer.id, true, true)
          customer.append(options).trigger('change')
          customer.trigger(
          {
            type: 'select2:select',
            params:
            {
              data: res.data.customer.id
            }
          })
          customer_id=res.data.customer.id
          $("#name-so").val(res.data.name)
          $("#tanggal-kirim").val(res.data.tanggal_kirim)
          $("#total-cost").val(res.data.total_price)
          $("#alamat-so").val(res.data.deskripsi)
          $("#shipper-so").val(res.data.shipper)
          total_cost=res.data.total_price
          $("#delivery-cost").val(res.data.delivery_cost)
          delivery_cost=res.data.delivery_cost
          discount=res.data.discount
          $("#price-discount").val(discount)
          $("#tax-cost").val(res.data.tax_cost)
          type=res.data.tipe
          $("#discount-so").val(res.discount_so)
          $("input[name='type-discount'][value='" + type + "']").prop('checked', true);
          if(type){
             $("#discount-so").removeClass('d-none')
             $('#discount-so').val(res.data.discount_so)
          }
          if(res.data.status_payment=="PAID"){
            $("#tambah").addClass('d-none')
          }

          res.data.detail.forEach(item=>{
            let action =add_action(res.data.status_payment,item)
            table.row.add([
                item.product.name,
                item.jumlah,
                item.price,
                action
            ]).draw(false)
           sub_total=sub_total+ (item.price *item.jumlah)
          })
          $("#sub-total").val(sub_total)
        }
    })
    function discount_SO(){
        if(type=="persen"){
            discount=sub_total*($('#discount-so').val()/100);
        }
        if(type=="nominal"){
            discount=$('#discount-so').val()
        }
        tax_cost=(sub_total-discount)*10/100
        total_cost=sub_total-discount+delivery_cost+tax_cost;
        $("#price-discount").val(discount)
        $("#total-cost").val(total_cost)
        $("#sub-total").val(sub_total)
        $("#tax-cost").val(tax_cost)
    }
    function add_action(status,item){
        if(status=="PAID"){
            return `
                    <div class="btn-group">
                    </div>
                   `
        }
        return `<div class="btn-group">
                    <button class="btn btn-update"  onclick="show_edit(${item.id})">detail</button>
                    <button class="btn btn-danger" onclick="delete_details(${item.id},'${item.price}','${item.jumlah}')">hapus</button>
                </div>`
    }
    function delivery_costfile(){
        delivery_cost =parseFloat($("#delivery-cost").val())
        tax_cost=(sub_total-discount)*10/100
        total_cost=sub_total-discount+delivery_cost+tax_cost;

        $("#tax-cost").val(tax_cost)
        $("#total-cost").val(total_cost)
    }
    function delete_details(id_det,price,jumlah){
            sub_total=sub_total-(parseFloat(price)*parseFloat(jumlah))
            if(type=="persen"){
            discount=sub_total*($('#discount-so').val()/100)
            }
            if(type=="nominal"){
                discount=parseFloat($('#discount-so').val())
            }
            tax_cost=(sub_total-discount)*10/100
            total_cost=sub_total-discount+tax_cost+delivery_cost;
            $("#price-discount").val(discount)
            $("#total-cost").val(total_cost)
            $("#tax-cost").val(tax_cost)
            $("#sub-total").val(sub_total)
            $.ajax({
                method:"Delete",
                url:`${api}/v1/detail-sales-order/${id_det}`,   
                headers:{
                      Authorization:`Bearer ${localStorage.getItem('token')}`
                },
                success:res=>{
                    sendToServer(true)
                },
                error:res=>{
                let  error=res.responseJSON
                    if(error.code!=500){
                        alert(error.message)
                     }else{
                        alert("hubungin backend")
                    }
                }
            })
            

            return false;
    }
    $(document).ready(function (){
        $("#customer-so").select2({
            ajax:{
                url:`${api}/v1/customer`,
                headers:{
                        Authorization:`Bearer ${localStorage.getItem('token')}`
                    },
                processResults:function(res){
                    let items=[]
                    res.data.forEach(e => {
                        let item={}
                        item.id=e.id
                        item.text=e.name
                        items.push(item)
                    });
                    return {
                        results:items
                    }
                }
            }
        })
        $("#add-product-id").select2({
            ajax:{
                url:`${api}/v1/product`,
                headers:{
                        Authorization:`Bearer ${localStorage.getItem('token')}`
                    },
                processResults:function(res){
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
    })


    function customer_data(){
        let id=$("#customer-so").val()
        $.ajax({
            method:"GET",
            url:`${api}/v1/customer/${id}`,
            headers:{
                Authorization:`Bearer  ${localStorage.getItem('token')}`
            },
            success:res=>{
                $('#alamat-so').val(res.data.address)
            }

        })
    }
    function checkEditPrice(){
        let id=$("#edit-product-id").val()
        $.ajax({
            method:"GET",
            url:`${api}/v1/product/${id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                $("#add-harga").val(res.data.harga)
            }
        })
    }
    function checkPrice(){
        let id=$("#add-product-id").val()
        $.ajax({
            method:"GET",
            url:`${api}/v1/product/${id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                $("#add-harga").val(res.data.harga)
            }
        })
    }
    function type_discounted(){
        type=$("#type-discount").val()
        console.log(type)
        $("#discount-so").removeClass('d-none')
    }
    function sendToServer(reload){
        let data={}
        data.name=$("#name-so").val()
        data.customer_id=$("#customer-so").val()
        data.shipper=$("#shipper-so").val()
        data.tanggal_kirim=$("#tanggal-kirim").val()
        data.tax_cost=$("#tax-cost").val()
        data.delivery_cost=$('#delivery-cost').val()
        data.total_price=$("#total-cost").val()
        data.discount=$("#price-discount").val()
        data.deskripsi=$("#alamat-so").val()
        $.ajax({
            method:"PUT",
            url:`${api}/v1/sales-order/${id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`,
            },
            contentType:"application/json",
            data:JSON.stringify(data),
            success:res=>{
                alert('data berhasil')
                if(reload==true){
                    window.location.reload()
                }
                else{
                    window.location.replace(`${url}/sales-order`)
                }
            },
            error:res=>{
                let  error=res.responseJSON
                if(error.code!=500){
                    alert(error.message)
                }else{
                    alert("hubungin backend")
                }
            }
        })
        return false;
    }

</script>
@endsection
