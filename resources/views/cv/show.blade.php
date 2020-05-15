@extends('layouts.app')
@section('content')

<div class="container" id="app">
    <div class="row">

        <div class="col-md-12">
            <h1>@{{message}}</h1>
            <div class="card border-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Experience</h3>
                            <button  class="btn btn-success float-right" @click="isHidden.experience = true">Add</button>
                        </div>

                    </div>
                 </div>
                <div class="card-body" >
                    <div v-if="isHidden.experience">

                        <div class="form-group" v-if="isHidden.experience" >
                         <label for="">Title</label>
                         <input type="text" name="titre" v-validate="'required'" v-bind:class="{'input':true,'is-danger':errors.has('titre')}" v-model="experience.titre" class="form-control" placeholder="Wrap the experience title">
                           <span v-html="errors.first("titre")"></span>
                        </div>

                           <div class="form-group">
                            <label for="">Body</label>
                            <textarea type="text" name="body" v-validate="'required|min:10|max:255'"  :class="{'input':true,'is-danger':errors.has('body')}" v-model="experience.body" class="form-control" placeholder="Wrap the experience body"></textarea>
                               <span v-show="errors.has('body')">@{{ errors.first('body') }}</span>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="">Start date</label>
                                       <input type="date" required v-model="experience.debut" class="form-control" placeholder="wrap the start date experience">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">End date</label>
                                    <input type="date" required v-model="experience.fin" class="form-control" placeholder="wrap the end date experience">
                                  </div>
                                </div>
                           </div>

                           <button   v-if="edit.experience"  class="btn btn-danger btn-block" @click="updateExperience" >Update</button>
                           <button   v-else class="btn btn-info btn-block" @click="addExperience">Add</button>
                           <button    class="btn btn-secondary btn-block" @click="isHidden.experience=false">Close</button>

                      </div>


                  <ul class="list-group">
                    <li class="list-group-item" v-for ="experience in experiences">
                      <div class="float-right">
                        <button class="btn btn-warning btn-sm" @click="editExperience(experience)">Edit</button>
                        <button class="btn btn-danger btn-sm" @click="deleteExperience(experience)">Delete</button>
                      </div>

                      <h3>@{{ experience.titre}}</h3>
                      <p>@{{ experience.body}} </p>
                       <small>@{{experience.debut}} - @{{experience.fin}}</small>
                    </li>
                  </ul>
                </div>

            </div>
            <hr>
            <div class="card border-primary">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="card-title">Training</h3>
                            <button  class="btn btn-success float-right" @click="isHidden.traning = true">Add</button>
                        </div>

                    </div>
                 </div>
                <div class="card-body" >
                    <div v-if="isHidden.traning">

                        <div class="form-group" v-if="isHidden.traning">
                         <label for="">Title</label>
                         <input type="text" name="titre" required v-model="traning.titre" class="form-control" placeholder="Wrap the traning title">
                        </div>

                           <div class="form-group">
                            <label for="">Description</label>
                            <textarea type="text" name="body"required  v-model="traning.description" class="form-control" placeholder="Wrap the traning description"></textarea>
                           </div>
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="">Start date</label>
                                       <input type="date" required v-model="traning.debut" class="form-control" placeholder="wrap the start date experience">
                                   </div>
                               </div>
                               <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="">End date</label>
                                    <input type="date" required v-model="traning.fin" class="form-control" placeholder="wrap the end date experience">
                                  </div>
                                </div>
                           </div>
                           <button  v-if="edit.traning"  class="btn btn-danger btn-block" @click="updateTraning" >Update</button>
                           <button v-else  class="btn btn-info btn-block" @click="addTraning">Add</button>
                           <button    class="btn btn-secondary btn-block" @click="isHidden.traning=false">Close</button>
                      </div>


                  <ul class="list-group">
                    <li class="list-group-item" v-for ="traning in tranings">
                      <div class="float-right">
                        <button class="btn btn-warning btn-sm" @click="editTraning(traning)">Edit</button>
                        <button class="btn btn-danger btn-sm" @click="deleteTraning(traning)">Delete</button>
                      </div>

                      <h3>@{{ traning.titre}}</h3>
                      <p>@{{ traning.description}} </p>
                       <small>@{{traning.debut}} - @{{traning.fin}}</small>
                    </li>
                  </ul>
                </div>
            </div>

        <hr>
        <div class="card border-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="card-title">Skills</h3>
                        <button  class="btn btn-success float-right" @click="isHidden.skill = true">Add</button>
                    </div>

                </div>
             </div>
            <div class="card-body" >
                <div v-if="isHidden.skill">

                    <div class="form-group" v-if="isHidden.skill" >
                     <label for="">Title</label>
                     <input type="text" name="titre" required v-model="skill.titre" class="form-control" placeholder="Wrap the experience title">
                    </div>

                       <div class="form-group">
                        <label for="">Description</label>
                        <textarea type="text" name="body"required  v-model="skill.description" class="form-control" placeholder="Wrap the experience body"></textarea>
                       </div>


                       <button   v-if="edit.skill"  class="btn btn-danger btn-block" @click="updateSkill" >Update</button>
                       <button   v-else class="btn btn-info btn-block" @click="addSkill">Add</button>
                       <button    class="btn btn-secondary btn-block" @click="isHidden.skill=false">Close</button>

                  </div>


              <ul class="list-group">
                <li class="list-group-item" v-for ="skill in skills">
                  <div class="float-right">
                    <button class="btn btn-warning btn-sm" @click="editSkill(skill)">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="deleteSkill(skill)">Delete</button>
                  </div>

                  <h3>@{{ skill.titre}}</h3>
                  <p>@{{ skill.description}} </p>

                </li>
              </ul>
            </div>

        </div>
        <hr>
        <div class="card border-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="card-title">Projects</h3>
                        <button  class="btn btn-success float-right" @click="isHidden.project = true">Add</button>
                    </div>

                </div>
             </div>
            <div class="card-body" >
                <div v-if="isHidden.project">

                    <div class="form-group" v-if="isHidden.project">
                     <label for="">Title</label>
                     <input type="text" name="titre" required v-model="project.titre" class="form-control" placeholder="Wrap the project title">
                    </div>

                       <div class="form-group">
                        <label for="">Description</label>
                        <textarea type="text" name="body"required  v-model="project.description" class="form-control" placeholder="Wrap the project description"></textarea>
                       </div>
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Project link</label>
                                <input type="text" required v-model="project.lien" class="form-control" placeholder="wrap the  project link">
                            </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                             <label for="">Project image</label>
                             <input type="text" required v-model="project.image" class="form-control" placeholder="wrap the project image">
                           </div>
                         </div>
                    </div>





                       <button  v-if="edit.project"  class="btn btn-danger btn-block" @click="updateProject" >Update</button>
                       <button v-else  class="btn btn-info btn-block" @click="addProject">Add</button>
                       <button    class="btn btn-secondary btn-block" @click="isHidden.project=false">Close</button>
                  </div>
                </div>


              <ul class="list-group">
                <li class="list-group-item" v-for ="project in projects">
                  <div class="float-right">
                    <button class="btn btn-warning btn-sm" @click="editProject(project)">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="deleteProject(project)">Delete</button>
                  </div>

                  <h3>@{{ project.titre}}</h3>
                  <p>@{{ project.description}} </p>
                  <small><a :href="project.lien" > Look... </a>@{{ project.image}} </small>
                </li>
              </ul>
            </div>
        </div>



      </div>
    </div>
</div>

@endsection
@section('javascript')

<script src="{{ asset('js/vue.js')}}"></script>
<script src="{{ asset('js/veeValidate.js') }}"></script>


<script  src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
<script>
    import Vue from 'vue';
import VeeValidate from 'vee-validate';

    Vue.use(VeeValidate);
    window.Laravel = {!! json_encode([
        'csrfToken'     => csrf_token(),
        'idExperience'  => $id,
        'url'           => url('/')
    ]) !!};
</script>
<script src="{{ asset('js/script.js') }}">
    



</script>

@endsection
