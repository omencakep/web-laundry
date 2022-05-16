<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                   <div class="card-header">
                        <h3 class="card-title mt-3">Data Pengurus</h3>
                        <div class="card-tools mt-2">
                        <button type="button" class="btn btn-primary" @click="showModal">Tambah Data +</button>
                        </div>
                    </div>
                    <div class="card-body">
                       
                           <div class="table-responsive">
                               <table class="table table-striped">
                                   <thead>
                                       
                                   <tr>
                                       <th>No</th>
                                       <th>Nama Pengurus</th>
                                       <th>Role</th>
                                       <th>Email</th>
                                       <th>Aksi</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                       
                                   <tr v-for="(item,no) in pengurus" :key="item.id">
                                       <td>{{no+1}}</td>
                                       <td>{{item.name}}</td>
                                       <td>{{item.role}}</td>
                                       <td>{{item.email}}</td>
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
        <!-- Modal -->
<div class="modal fade" id="tampilmodal" tabindex="-1" role="dialog" aria-labelledby="tampilmodal1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Member</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form @submit.prevent="simpanData()">
      <div class="modal-body">
        <div class="form-group">
            <input type="text" v-model="form.name" class="form-control" placeholder="Masukkan Nama Pengurus"
            :class="{'is-invalid':form.errors.has('name')}"
            required>
            <has-error :form="form" field="name"></has-error>
        </div>
        <div class="form-group">
            <select v-model="form.role" class="form-control"
            :class="{'is-invalid':form.errors.has('role')}"
            required>
                <option value=""  selected>--Pilih--</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>
            </select>
            <has-error :form="form" field="role"></has-error>
        </div>
        <div class="form-group">
            <input type="email" v-model="form.email" class="form-control" placeholder="Masukkan Email"
            :class="{'is-invalid':form.errors.has('email')}"
            required>
            <has-error :form="form" field="email"></has-error>
        </div>
        <div class="form-group">
            <input type="password" v-model="form.password" class="form-control" placeholder="Masukkan Password"
            :class="{'is-invalid':form.errors.has('password')}"
            required>
            <has-error :form="form" field="password"></has-error>
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
                pengurus :{},
                form: new Form({
                    id: '',
                    name: '',
                    role:'',
                    email:'',
                    password:'',
                    
                })
            };
        },
        methods:{
            showModal(){
            this.form.reset();
            $("#tampilmodal").modal("show");
                
            },
            loadData(){
                axios.get('api/getdatapengurus').then(({data}) => this.pengurus = data);
            },
            simpanData(){
                this.form.post('api/simpanpengurus').then(()=>{
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
