@extends('layout.admin')
@section('isi')
<script src="{{asset('datatable.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('datatable.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@section('content')
<div class="row">
    <div class="col-12 my-3">
        <button class="btn btn-success" onclick="tambah()">Tambah</button>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">Daftar Sales Order </div>
            <div class="card-body">
                <div class="col-12 table-responsive">
                    <table id="data">
                        <thead>
                            <th>Customer</th>
                            <th>PIC</th>
                            <th>jumlah Pesanan</th>
                            <th>Shipper</th>
                            <th>tanggal kirim</th>
                            <th>Biaya</th>
                            <th>Status</th>
                            <th>Status Payment</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        let table=$("#data").DataTable()
        function tambah(){
            window.location.replace(`${url}/sales-order/create`)
         }
         function detail(id){
            window.location.replace(`${url}/sales-order/${id}`)
         }
        $.ajax({
            method:"GET",
            url:`${api}/v1/sales-order?with=customer&count=detail`,
            headers:{
                Authorization:`Bearer ${localStorage.getItem('token')}`
            },
            success:res=>{
                console.log(res)
                res.data.forEach(item=> {
                    let action =checkaction(item.id,item.status,item.status_payment)
                    table.row.add([
                        item.customer.name,
                        item.name,
                        item.detail_count,
                        item.shipper,
                        item.tanggal_kirim,
                        item.total_price,
                        item.status,
                        item.status_payment,
                        action
                    ]).draw(false)
                });
            }
        })
       function checkaction(id,status,payment){
            if(status=="Order"){
                return `<div class="btn-group">
                                  <button class="btn btn-success" onclick="changestatus(${id},'Approved','Unpaid')">Approved (Unpaid)</button>
                                  <button class="btn btn-danger"  onclick="changestatus(${id},'Rejected','Unpaid')">Rejected</button>
                                  <button class="btn btn-primary" onclick="detail(${id})">detail</button>
                                  <button class="btn btn-danger" onclick="hapus(${id})"> Hapus</button>
                        </div>`
            }
            console.log(payment);
            if(status=="Approved"){
                return `<div class="btn-group">
                            <button class="btn btn-success" onclick="changestatus(${id},'Paid','Paid')">BAYAR</button>
                            <button class="btn btn-danger" onclick="changestatus(${id},'Rejected','Canceled')">Cancel</button>
                            <button class="btn btn-primary" onclick="detail(${id})">detail</button>
                            <button class="btn btn-danger" onclick="hapus(${id})"> Hapus</button>
                        </div>`
            }

            if(status=="PAID" && payment=="PAID"){
                    return `<div class="btn-group">

                        </div>
                    `

            }

         return ''
        }
        function changestatus(id,status,payment){
            $.ajax({
                method:"patch",
                url:`${api}/v1/sales-order/${id}/${status}/${payment}`,
                headers:{
                    Authorization:`Bearer ${localStorage.getItem('item')}`
                },
                success:res=>{
                    alert('Berhasil Data updated')
                    window.location.reload()
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
        }

        function hapus(id){
            $.ajax({
                method:"DELETE",
                url:`${api}/v1/sales-order/${id}`,
                headers:{
                    Authorization:`Bearer ${localStorage.getItem('token')}`
                },
                success:res=>{
                    alert('Berhasil dihapus')
                    window.location.reload()
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
        }
    </script>
@endsection

