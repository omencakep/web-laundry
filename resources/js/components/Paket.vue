<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-3">Data Paket</h3>
                        <div class="card-tools mt-2">
                        <button type="button" class="btn btn-primary" @click="showModal">Tambah Data +</button>
                        </div>
                    </div>
                    <div class="card-body">
                       <div class="form-group">
                           <div class="table-responsive">
                               <table class="table table table-striped">
                                   <thead>
                                   <tr>
                                       <th>No</th>
                                       <th>Nama Outlet</th>
                                       <th>Nama Paket</th>
                                       <th>Jenis Paket</th>
                                       <th>Harga</th>
                                       <th>Aksi</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   <tr v-for="(item,no) in paket" :key="item.id" >
                                       <td>{{no+1}}</td>
                                       <!-- <td v-for="item in outlet" :key="item.id" >{{item.nama}} </td> -->
                                       <td>{{item.id_outlet}} </td>
                                       <td>{{item.nama_paket}}</td>
                                       <td>{{item.jenis}}</td>
                                       <td>{{item.harga}}</td>
                                       <td>
                                           <a href="#" class="btn btn-success">Edit</a>
                                           <a href="#" class="btn btn-danger">Hapus</a>
                                       </td>
                                   </tr>
                                   </tbody>
                               </table>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
<div class="modal fade" id="tampilmodal" tabindex="-1" role="dialog" aria-labelledby="tampilmodal1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Paket</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="simpanData()">
      <div class="modal-body">
        <div class="form-group">
            <select v-model="form.id_outlet" class="form-control"
            :class="{'is-invalid':form.errors.has('id_outlet')}"
            required>
                <option value="" selected>--Pilih--</option>
                <option v-for="item in outlet" :key="item.id" :value="item.id">{{item.nama}}</option>
            </select>
            <has-error :form="form" field="id_outlet"></has-error>
        </div>
        <div class="form-group">
            <input type="text" v-model="form.nama_paket" class="form-control" placeholder="Nama Paket"
            :class="{'is-invalid':form.errors.has('nama_paket')}"
            required>
            <has-error :form="form" field="nama_paket"></has-error>
        </div>
        <div class="form-group">
            <select v-model="form.jenis" class="form-control"
            :class="{'is-invalid':form.errors.has('jenis')}"
            required>
                <option value="" selected>--Pilih--</option>
                <option value="kiloan">Kiloan</option>
                <option value="selimut">Selimut</option>
                <option value="bed_cover">Bed Cover</option>
                <option value="kaos">Kaos</option>
                <option value="lain">Lainnya</option>
            </select>
            <has-error :form="form" field="jenis"></has-error>
        </div>
        <div class="form-group">
            <input type="number" v-model="form.harga" class="form-control" placeholder="Harga"
            :class="{'is-invalid':form.errors.has('harga')}"
            required>
            <has-error :form="form" field="harga"></has-error>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan data</button>
      </div>
      </form>

    </div>
  </div>
</div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                paket :{},
                outlet :{},
                form: new Form({
                    id: '',
                    id_outlet:'',
                    nama_paket:'',
                    jenis:'',
                    harga:'',
                })
            };
        },
        methods:{
            showModal(){
                this.form.reset();
                $("#tampilmodal").modal("show");
                
            },
            loadData(){
                axios.get('api/getdatapaket').then(({data}) => this.paket = data);
                axios.get('api/getdataoutlet').then(({data}) => this.outlet = data);
            },
            simpanData(){
                this.form.post('api/simpanpaket').then(()=>{
                    $("#tampilmodal").modal("hide");
                     Fire.$emit("refreshData");
                    $("#tampilmodal").modal("hide");
                    const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                    Toast.fire({
                    icon: 'success',
                    title: 'Berhasil menambahkan data!'
                    });
                })
                .catch();
            }

        },
        created(){
            this.loadData();
            Fire.$on('refreshData', () => {
            this.loadData();
            });
        }

    }
</script>
