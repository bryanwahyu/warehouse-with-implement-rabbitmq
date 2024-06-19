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
                        <button class="btn btn-primary" onclick="show_modal()">Tambah</button>
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
                    <button class="btn btn-primary" onclick="sendToServer()">Buat</button>
                </div>
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
    let table=$('#table').DataTable()
    let details=[]
    let sequence=0
    let sub_total=0
    let total_cost=0
    let tax_cost=0
    let delivery_cost=0
    let type=null
    let discount=0
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
    function delivery_costfile(){
        delivery_cost =parseFloat($("#delivery-cost").val())
        tax_cost=(sub_total-discount)*10/100
        total_cost=sub_total-discount+delivery_cost+tax_cost;

        $("#tax-cost").val(tax_cost)
        $("#total-cost").val(total_cost)
    }
    function delete_details(id){
            sequence=0
            sub_total=0;
            details=details.filter(ele=>{
                return ele.sequence!=id
            })
            table.clear().draw()
            details.forEach(items => {
                sequence++;
                sub_total=sub_total+(items.jumlah*items.price)

                items.sequence=sequence
                let action=`<button class="btn btn-danger" onclick="delete_details(${items.sequence})"> hapus</button>`
                table.row.add([
                    items.product.name,
                    items.jumlah,
                    items.price,
                    action
                ]).draw(false)
            });

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

    function add_pesanan(){
        let data={}
        data.product_id=$("#add-product-id").val()
        data.price=$('#add-harga').val()
        data.jumlah=$('#add-jumlah-pesanan').val()
        $.ajax({
            method:"Get",
            url:`${api}/v1/product/${data.product_id}`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                sequence++
                let product=res.data
                data.product=product
                data.sequence=sequence
                details.push(data)
                let action=`<button class="btn btn-danger" onclick="delete_details(${data.sequence})"> hapus</button>`
                table.row.add([
                    data.product.name,
                    data.jumlah,
                    data.price,
                    action
                ]).draw(false)
                sub_total=sub_total+(data.price*data.jumlah)

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
                $('#tambah-modal').modal('hide')
            }
        })
        return false
    }

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
    function sendToServer(){
        let data={}
        data.name=$("#name-so").val()
        data.tipe=type
        data.discount_so=$("#discount-so").val()
        data.customer_id=$("#customer-so").val()
        data.shipper=$("#shipper-so").val()
        data.tanggal_kirim=$("#tanggal-kirim").val()
        data.details=details;
        data.tax_cost=$("#tax-cost").val()
        data.delivery_cost=$('#delivery-cost').val()
        data.total_price=$("#total-cost").val()
        data.discount=$("#price-discount").val()
        data.deskripsi=$("#alamat-so").val()
        $.ajax({
            method:"POST",
            url:`${api}/v1/sales-order`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`,
            },
            contentType:"application/json",
            data:JSON.stringify(data),
            success:res=>{
                alert('data berhasil')
                window.location.replace(`${url}/sales-order`)
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
