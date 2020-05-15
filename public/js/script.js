new Vue({
    el: '#app',
    data: {
        message: 'Je suis Adam Hamdi',

        experiences: [],
        tranings: [],
        skills: [],
        projects: [],


        isHidden: {
            experience: false,
            traning: false,
            skill: false,
            project: false,

        },

        experience: {
            id: 0,
            cv_id: window.Laravel.idExperience,
            titre: '',
            body: '',
            debut: '',
            fin: ''

        },
        traning: {
            id: 0,
            cv_id: window.Laravel.idExperience,
            titre: '',
            description: '',
            debut: '',
            fin: ''
        },
        skill: {
            id: 0,
            cv_id: window.Laravel.idExperience,
            titre: '',
            description: '',

        },
        project: {
            id: 0,
            cv_id: window.Laravel.idExperience,
            titre: '',
            description: '',
            lien: '',
            image: '',

        },
        edit: {
            experience: false,
            traning: false,
            skill: false,
            project: false,

        },
    },

    methods: {

        getData: function() {

            axios.get(window.Laravel.url + '/getdata/' + window.Laravel.idExperience)
                //axios.get('http://localhost:8000/getexperiences')
                .then(response => {
                    console.log(response.data);
                    this.experiences = response.data.experiences;
                    this.tranings = response.data.tranings;
                    this.skills = response.data.skills;
                    this.projects = response.data.projects;
                })
                .catch(error => {
                    console.log('errors :', error);
                })
        },
        addExperience: function() {
            axios.post(window.Laravel.url + '/addexperience', this.experience)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.experience = false;
                        this.experience.id = response.data.id;
                        this.experiences.unshift(this.experience);
                        //unshift ajouter une experience au debut de liste et push a la fin
                        // le code suivant pour initialiser le formulaire (vide)
                        this.experience = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            body: '',
                            debut: '',
                            fin: ''

                        }

                    }


                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        editExperience: function(experience) {
            this.isHidden.experience = true;
            this.edit.experience = true;
            this.experience = experience;

        },


        updateExperience: function() {
            axios.put(window.Laravel.url + '/updateexperience', this.experience)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.experience = false;

                        this.experience = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            body: '',
                            debut: '',
                            fin: ''

                        }

                    }

                    this.edit.experience = false;
                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        deleteExperience: function(experience) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',

                    cancelButton: 'btn btn-warning'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',

                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    axios.delete(window.Laravel.url + '/deleteexperience/' + experience.id)
                        .then(response => {
                            if (response.data.etat) {
                                var position = this.experiences.indexOf(experience);
                                //splice pour supprimer un element(position ,nombre d'element à supprimer)
                                this.experiences.splice(position, 1);
                            }
                        })
                        .catch(error => {
                            console.log('errors:', error);
                        })
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })



        },
        addTraning: function() {
            axios.post(window.Laravel.url + '/addtraning', this.traning)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.traning = false;
                        this.traning.id = response.data.id;
                        this.tranings.unshift(this.traning);
                        //unshift ajouter une experience au debut de liste et push a la fin
                        // le code suivant pour initialiser le formulaire (vide)
                        this.traning = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            description: '',
                            debut: '',
                            fin: ''

                        }

                    }


                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        editTraning: function(traning) {
            this.isHidden.traning = true;
            this.edit.traning = true;
            this.traning = traning;

        },


        updateTraning: function() {
            axios.put(window.Laravel.url + '/updatetraning', this.traning)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.traning = false;

                        this.traning = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            description: '',
                            debut: '',
                            fin: ''

                        }

                    }

                    this.edit.traning = false;

                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        deleteTraning: function(traning) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',

                    cancelButton: 'btn btn-warning'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',

                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    axios.delete(window.Laravel.url + '/deletetraning/' + traning.id)
                        .then(response => {
                            if (response.data.etat) {
                                var position = this.tranings.indexOf(traning);
                                //splice pour supprimer un element(position ,nombre d'element à supprimer)
                                this.tranings.splice(position, 1);
                            }
                        })
                        .catch(error => {
                            console.log('errors:', error);
                        })
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })



        },

        addSkill: function() {
            axios.post(window.Laravel.url + '/addskill', this.skill)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.skill = false;
                        this.skill.id = response.data.id;
                        this.skills.unshift(this.skill);
                        //unshift ajouter une experience au debut de liste et push a la fin
                        // le code suivant pour initialiser le formulaire (vide)
                        this.skill = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            description: ''


                        }

                    }


                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        editSkill: function(skill) {
            this.isHidden.skill = true;
            this.edit.skill = true;
            this.skill = skill;

        },


        updateSkill: function() {
            axios.put(window.Laravel.url + '/updateskill', this.skill)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.skill = false;

                        this.skill = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            description: ''


                        }

                    }

                    this.edit.skill = false;

                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        deleteSkill: function(skill) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',

                    cancelButton: 'btn btn-warning'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',

                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    axios.delete(window.Laravel.url + '/deleteskill/' + skill.id)
                        .then(response => {
                            if (response.data.etat) {
                                var position = this.skills.indexOf(skill);
                                //splice pour supprimer un element(position ,nombre d'element à supprimer)
                                this.skills.splice(position, 1);
                            }
                        })
                        .catch(error => {
                            console.log('errors:', error);
                        })
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })



        },

        addProject: function() {
            // axios.post('http://localhost:8000/addproject')
            axios.post(window.Laravel.url + '/addproject', this.project)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.project = false;
                        this.project.id = response.data.id;
                        this.projects.unshift(this.project);
                        //unshift ajouter une experience au debut de liste et push a la fin
                        // le code suivant pour initialiser le formulaire (vide)
                        this.project = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            description: '',
                            lien: '',
                            image: ''


                        }

                    }


                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        editProject: function(project) {
            this.isHidden.project = true;
            this.edit.project = true;
            this.project = project;

        },


        updateProject: function() {
            axios.put(window.Laravel.url + '/updateproject', this.prject)
                .then(response => {
                    if (response.data.etat) {
                        this.isHidden.project = false;

                        this.project = {
                            id: 0,
                            cv_id: window.Laravel.idExperience,
                            titre: '',
                            description: '',
                            lien: '',
                            image: ''


                        }

                    }

                    this.edit.prject = false;
                })


            .catch(error => {
                console.log('errors:', error);
            })

        },
        deleteProject: function(project) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',

                    cancelButton: 'btn btn-warning'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,

                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',

                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    axios.delete(window.Laravel.url + '/deleteskill/' + project.id)
                        .then(response => {
                            if (response.data.etat) {
                                var position = this.projects.indexOf(project);
                                //splice pour supprimer un element(position ,nombre d'element à supprimer)
                                this.projects.splice(position, 1);
                            }
                        })
                        .catch(error => {
                            console.log('errors:', error);
                        })
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        }
    },
    /**addErrorToChildComponents: function(app, field, errorString) {
        if (app && app.$validator && app.$validator.errors) {
            const inputfield = app.$validator.fields.find({ name: field });
            if (inputfield) {
                app.$validator.errors.add({
                    field,
                    msg: errorString
                });
                return;
            }
        }
        if (app.$children) {
            app.$children.map(async($cvm) => {
                addErrorToChildComponents($cvm, field, errorString);
            });
        }
        return

    },**/
    mounted: function() {
        this.getData();
    }

});