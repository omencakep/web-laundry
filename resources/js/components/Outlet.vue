<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-3">Data Outlet</h3>
                        <div class="card-tools mt-2">
                        <button type="button" class="btn btn-primary" @click="showModal">Tambah Data +</button>
                        </div>
                    </div>

                    <div class="card-body">
                       <div class="form-group">
                           <div class="table-responsive">
                               <table class="table table-striped">
                                   <thead>

                                   <tr>
                                       <th>No</th>
                                       <th>Nama Outlet</th>
                                       <th>Alamat Outlet</th>
                                       <th>Telp Outlet</th>
                                       <th>Aksi</th>
                                   </tr>
                                   </thead>
                                   <tbody>

                                   <tr v-for="(item,no) in outlet" :key="item.id">
                                       <td>{{no+1}}</td>
                                       <td>{{item.nama}}</td>
                                       <td>{{item.alamat}}</td>
                                       <td>{{item.telp}}</td>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Outlet</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="simpanData()">
      <div class="modal-body">
        <div class="form-group">
            <input type="text" v-model="form.nama" class="form-control"  placeholder="Nama Outlet"
            :class="{'is-invalid':form.errors.has('nama')}"
            required>
            <has-error :form="form" field="nama"></has-error>
        </div>
        <div class="form-group">
            <input type="text" v-model="form.alamat" class="form-control" placeholder="Alamat Outlet"
            :class="{'is-invalid':form.errors.has('alamat') }"
            required>
            <has-error :form="form" field="alamat"></has-error>
        </div>
        <div class="form-group">
            <input type="text" v-model="form.telp" class="form-control" placeholder="Nomor Telp"
            :class="{'is-invalid':form.errors.has('telp')}"
            required>
            <has-error :form="form" field="telp"></has-error>
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
                outlet :{},
                form: new Form({
                    id: '',
                    nama:'',
                    alamat:'',
                    telp:'',
                })
            };
        },
        methods:{
            showModal(){
                this.form.reset();
                $("#tampilmodal").modal("show");
                
            },
            loadData(){
                axios.get('api/getdataoutlet').then(({data}) => this.outlet = data);
            },
            simpanData(){
                this.form.post('api/simpanoutlet').then(()=>{
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
