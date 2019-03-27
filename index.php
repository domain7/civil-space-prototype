<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="theme.css" type="text/css"> 
</head>



<body>
    <nav class="navbar navbar-expand-md navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-primary" href="#">
                <i class="fa d-inline fa-lg fa-stop-circle text-light"></i>
                <b class="text-light"> Our City Logo</b>
            </a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar4" aria-expanded="true">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="navbar-collapse collapse show" id="navbar4">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown text-light">
                        <a class="nav-link dropdown-toggle text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">English</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">English</a>
                            <a class="dropdown-item" href="#">French</a>
                            <a class="dropdown-item" href="#">Spanish</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="app">
        <div class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-7 order-first">
                        <h1 class="display-1">How do you think we should best use the Greenway Route</h1>
                    </div>
                    <div class="col-sm-12 col-md-5 text-right order-last"><a class="btn btn-link" style="color:#55acee" target="_blank" href="#"><i class="fa fa-fw fa-1x py-1 fa-reply"></i>&nbsp;Back to overview</a></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-7" id="idea-region">
                        <form class="form-inline">
                            <div class="input-group w-100">
                                <input type="text" class="form-control" id="idea-search" placeholder="Enter an idea or search for an existing one..." name="">
                                <div class="input-group-append"><button class="btn btn-light" type="button"><i class="fa fa-search"></i></button></div>
                            </div>
                        </form>
                        <div id="add-button-region" class="row text-center mt-3 invisible">
                            <div class="col-md-12">
                                <p>Vote for an existing idea&nbsp; - or -<a class="btn btn-secondary ml-2" href="#" data-toggle="modal" data-target="#add-idea-modal" id="add-idea-btn"><i class="fa fa-plus mr-2"></i> Add a New Idea</a></p>
                            </div>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item"> <a href="" class="nav-link active" data-toggle="tab" data-target="#tabone">Most Popular</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="" data-toggle="tab" data-target="#tabtwo">Most Recent</a> </li>
                            <li class="nav-item"> <a href="" class="nav-link" data-toggle="tab" data-target="#tabthree">Most Divisive</a> </li>
                        </ul>
                        <div class="tab-content mt-2">
                            <div class="tab-pane fade active show" id="tabone" role="tabpanel">
                                <div class='card mb-2' v-for="idea in ideas">
                                        <div class='card-body p-0'>
                                            <div class='row no-gutters'>
                                                <div class='col-sm-6 col-md-9 p-2'>
                                                    <h5 class='card-title'><b>{{ idea.title }}</b></h5>
                                                    <h6 class='card-subtitle my-2 text-muted'><small>Submitted by {{ idea.username }}</small></h6>
                                                    <p class='card-text'>{{ idea.description }}</p>
                                                </div>
                                                <div class='col-sm-6 col-md-3 vote-panel '>
                                                    <div class='row no-gutters'>
                                                        <div class='col-md-12'>
                                                            <p class='label p-2 m-0'><strong>Like this idea?</strong></p>
                                                        </div>
                                                    </div>
                                                    <div class='row no-gutters align-items-center ml-2 mb-1'>
                                                        <div class='col-7'><button class='btn btn-outline-primary btn-block btn-lg'@click="vote('like',idea.id)"><i class='fa fa-fw fa-thumbs-up'></i></button></div>
                                                        <div class='col-3 text-center'>
                                                            <span class='label'>{{ idea.likes }}</span>
                                                        </div>
                                                    </div>
                                                    <div class='row no-gutters align-items-center ml-2 mb-1'>
                                                        <div class='col-7'><button class='btn btn-outline-primary btn-lg btn-block'@click="vote('dislike',idea.id)"><i class='fa fa-fw fa-thumbs-down fa-flip-horizontal'></i></button></div>
                                                        <div class='col-3 text-center'>
                                                            <span class='label'>{{ idea.dislikes }}</span>
                                                        </div>
                                                    </div>
                                                    <div class='row'>
                                                        <div class='col-md-12'>
                                                            <p class='label p-2 m-0'>Idea iterations <strong>18</strong></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="tab-pane fade" id="tabtwo" role="tabpanel"></div>
                            <div class="tab-pane fade" id="tabthree" role="tabpanel"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" ref="addIdeaModal" id="add-idea-modal">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal"> <span>×</span> </button>
                    </div>
                    <div class="modal-body p-5">
                        <h4 class="modal-title text-center mb-4">Tell us about your idea</h4>
                        <form>
                            <div class="form-group"> <label>Give your idea a title</label> <input type="text" class="form-control" placeholder="Add a Childres Play Park" v-model='title'> </div>
                            <div class="form-group"> <label>Describe your idea</label><br><textarea class="form-control" rows="5" v-model='description'></textarea></div>
                            <div class="form-group"> <label>Your name (optional)</label> <input type="text" class="form-control" placeholder="" v-model='username'> </div>
                            <div class="form-group"> <label>Your email </label> <input type="email" class="form-control" placeholder="" v-model='email'> </div>
                            <p> This form collects your name and email so that we can send you updates about your  Check out our <a href="">Privacy Policy</a> and <a href="">Terms of Use</a> to see how we protect and manage your submitted data. </p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1"> I consent to having Our City collect my name and email address.* </label>
                            </div>
                            <div class="row mt-4 text-center justify-content-center">
                                <div class="col-sm-6 col-lg-4">
                                    <button type="button" class="btn btn-primary btn-md btn-block mb-2" value='Add' @click='newIdea();'>Submit Your Idea</button>
                                    <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6"><a class="btn btn-outline-secondary btn-lg btn-block" href="#">Pervious</a></div>
                        <div class="col-md-6"><a class="btn btn-secondary btn-lg btn-block" href="#">Next</a></div>
                    </div>
                </div>
                <div class="col-md-6 text-right"><a class="btn btn-outline-secondary btn-lg quit-survey" href="#">Quit Survey</a></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css"/>

    <script src="//unpkg.com/@babel/polyfill@latest/dist/polyfill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>

    <script>
        var app = new Vue({
                el: '#app',
             
                data: {
                    ideas: '', // this is for listing exsisting ideas
                    
                    // these are for the form inputs
                    title: '',
                    description: '',
                    username: '',
                    email: ''
                },
                mounted: function (){
                    console.log('Hi!');
                    this.getIdeas();
                },
                methods: {
                    getIdeas: function(){
                        
                        axios.get('api/getIdeas.php')
                        .then(response => {
                            
                            app.ideas = response.data
                            console.log(app.ideas);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    },
                    newIdea: function(){
                        if(this.username != '' && this.name != '' && this.email != ''){

                            let formData = new FormData();
                            formData.append("request", 1)
                            formData.append("title", this.title)
                            formData.append("description", this.description)
                            formData.append("username", this.username)
                            formData.append("email", this.email)


                            axios({
                                method: 'post',
                                url: 'api/newIdea.php',
                                data: formData,
                                config: {headers: {'Content-Type': 'multipart/form-data'}}
                            })
                            .then(function (response) {

                                // Fetch records
                                // this.getIdeas();
                                
                                $('#add-idea-modal').modal('toggle');
                                axios.get('api/getIdeas.php')
                                .then(response => {
                                    app.ideas = response.data
                                    console.log(app.ideas);
                                })

                                // Empty values
                                app.title = '';
                                app.description = '';
                                app.username = '';
                                app.email = '';
                        
                                // alert(response.data);
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                            }else{
                                alert('You are missing some information.');
                        }
                    },
                    vote: function(type,id,dislikes){
                        console.log(type);
                        console.log(id);
                        $vote = (type == 'like') ? 2 : 3;
                        
                        console.log($vote);
                        let formData = new FormData();
                        formData.append("request", $vote);
                        formData.append("id", id);
                        axios({
                            method: 'post',
                            url: 'api/newIdea.php',
                            data: formData,
                            config: {headers: {'Content-Type': 'multipart/form-data'}}
                        })
                        .then(function (response) {


                            axios.get('api/getIdeas.php')
                            .then(response => {
                                app.ideas = response.data
                                console.log(app.ideas);
                            })

                        })
                        .catch(function (error) {
                            console.log(error);
                        });



                    }
                }
            })

        $("#idea-search").focus(function() {
            $('#add-button-region').toggleClass("invisible");
        });


        
    </script>
</body>

</html>