Vue.filter('highlight', function(words, query) {
    return words.replace(query, '<span class=\'highlight\'>' + query + '</span>')
});


var app = new Vue({
    el: '#app',

    data: {
        ideas: [], // this is for listing exsisting ideas

        iterations: [],

        // these are for the form inputs
        id: '',
        title: '',
        description: '',
        username: '',
        email: '',
        comment: '',
        baseURL: window.location.origin,
        modalTitle: '',
        modalID: '',
        search: '',
        currentOrder: '',
        userVotes: [],
        iterationLikes: [],
        searchQuery: ''

    },
    mounted: function() {
        this.getIdeas();
        console.log("cookie:" + Cookies.get('votes'));
        if (Cookies.get('votes') == undefined) {
            Cookies.set('votes', '');
            console.log("cookie created:" + Cookies.get('votes'));
        } else {
            this.userVotes = Cookies.getJSON('votes');
        }
        // set iteration likes cookie
        if (Cookies.get('iterationLikes') == undefined) {
            Cookies.set('iterationLikes', '');
            console.log("cookie created:" + Cookies.get('iterationLikes'));
        } else {
            this.iterationLikes = Cookies.getJSON('iterationLikes');
        }


    },
    methods: {
        getIdeas: function() {

            axios.get('api/getIdeas.php')
                .then(response => {
                    app.ideas = response.data
                    console.log(app.ideas);

                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        newIdea: function() {
            if (this.username != '' && this.name != '' && this.email != '') {

                let formData = new FormData();
                formData.append("request", "new")
                formData.append("title", this.title)
                formData.append("description", this.description)
                formData.append("username", this.username)
                formData.append("email", this.email)


                axios({
                        method: 'post',
                        url: 'api/newIdea.php',
                        data: formData,
                        config: {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    })
                    .then(function(response) {

                        // Fetch records



                        axios.get('api/getIdeas.php')
                            .then(response => {
                                app.ideas = response.data
                                console.log(app.ideas);

                                $('#idea-search').val('')

                                $('#add-idea-modal').modal('toggle');
                                $('a.nav-link.active').toggleClass('active');
                                $('a.nav-link.most-recent').toggleClass('active');

                                app.search = ''




                                app.sortBy('-id')
                            })

                        // Empty values
                        app.title = '';
                        app.description = '';
                        app.username = '';
                        app.email = '';

                        // alert(response.data);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            } else {
                alert('You are missing some information.');
            }
        },
        like: function(id) {

            // console.log(id);

            // update userVotes array
            if (app.userVotes == undefined) {
                app.userVotes = new Array();
            }
            app.userVotes.push({
                'id': id,
                'vote': 'liked'
            });


            // console.log(vote);
            let formData = new FormData();
            formData.append("request", 'liked');
            formData.append("id", id);
            axios({
                    method: 'post',
                    url: 'api/newIdea.php',
                    data: formData,
                    config: {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                })
                .then(function(response) {


                    axios.get('api/getIdeas.php')
                        .then(response => {
                            app.ideas = response.data
                            console.log(app.ideas);
                        })

                })
                .catch(function(error) {
                    console.log(error);
                });



        },
        dislike: function(id) {
            console.log(id);
            // update userVotes array
            this.userVotes.push({
                'id': id,
                'vote': 'disliked'
            });
            let formData = new FormData();
            formData.append("request", 'disliked');
            formData.append("id", id);
            axios({
                    method: 'post',
                    url: 'api/newIdea.php',
                    data: formData,
                    config: {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                })
                .then(function(response) {


                    $('#iterate-idea-modal').modal('toggle');

                    axios.get('api/getIdeas.php')
                        .then(response => {
                            app.ideas = response.data
                            console.log(app.ideas);
                        })

                })
                .catch(function(error) {
                    console.log(error);
                });



        },
        newIteration: function(ideaID) {

            if (this.comment != '') {


                let formData = new FormData();
                formData.append("comment", this.comment)
                formData.append("ideaID", app.modalID)


                axios({

                        method: 'post',
                        url: 'api/newIteration.php',
                        data: formData,
                        config: {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }

                    })
                    .then(function(response) {
                        // Close the modal
                        $('#iterate-idea-modal').modal('toggle');

                        // Fetch idea records again  
                        axios.get('api/getIdeas.php')
                            .then(response => {
                                app.ideas = response.data
                                console.log(app.ideas);
                            })

                        // Empty values
                        app.comment = '';
                        app.id = '';

                        // alert(response.data);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            } else {
                alert('You are missing some information.');
            }

        },
        iterationModalVisibility: function(isVisible, entry) {
            this.isVisible = isVisible
            console.log(isVisible);

        },
        getIterations: function(ideaID) { //this will also open the modal


            axios.get(app.baseURL + '/api/getIterations.php?ideaID=' + ideaID)


            .then(response => {

                    $('#iterate-idea-modal').modal('toggle');
                    app.iterations = response.data
                        // console.log(typeof app.iterations)
                    console.log(response.data);

                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        likeIteration: function(iterationID, ideaID) {
            console.log(iterationID)
            this.iterationLikes.push({
                'id': iterationID
            });
            Cookies.set("iterationLikes", JSON.stringify(this.iterationLikes));
            let formData = new FormData();
            formData.append("id", iterationID);
            axios({
                    method: 'post',
                    url: 'api/likeIteration.php',
                    data: formData,
                    config: {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                })
                .then(function(response) {

                    axios.get(app.baseURL + '/api/getIterations.php?ideaID=' + ideaID)
                        .then(response => {
                            app.iterations = response.data
                            console.log(app.ideas);
                        })

                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        sendSearch: function(arg) {
            app.title = arg
            console.log(app.title)

        },
        sendTitle: function(title) {
            app.modalTitle = title

        },
        sendID: function(ID) {
            app.modalID = ID

        },
        showAddButton: function() {

            $('#add-button-region').removeClass("invisible");
        },
        sortBy: function(key) {
            // console.log(this.ideas)
            function dynamicSort(property) {
                var sortOrder = 1;
                if (property[0] === "-") {
                    sortOrder = -1;
                    property = property.substr(1);
                }
                return function(a, b) {
                    var result = (parseInt(a[property]) < parseInt(b[property])) ? -1 : (parseInt(a[property]) > parseInt(b[property])) ? 1 : 0;
                    return result * sortOrder;
                }
            }

            return app.ideas.sort(dynamicSort(key));

        },
        tabClick: function(thisTab) {
            $('a.nav-link.active').toggleClass('active');
            $('a.nav-link.' + thisTab).toggleClass('active');
        },
        voteChecker: function(id, btnType) {
            // check for a vote
            ideaObj = _.find(app.userVotes, {
                'id': id
            });
            // console.log(ideaObj)
            if ((ideaObj != undefined) && (ideaObj.vote == btnType)) {
                return ideaObj.vote + " disabled"
            } else if (ideaObj != undefined) {
                return "disabled"
            }

        },
        iterationLikeChecker: function(id) {
            // check for a vote
            iterationObj = _.find(app.iterationLikes, {
                'id': id
            });
            // console.log(ideaObj)
            if (iterationObj != undefined) {
                return "liked disabled"
            }

        },
        clearSearch: function() {

            console.log(this.search)
            this.search = ''
        },
        isDisabled: function(id, type) {
            switch (type) {
                case undefined:
                    ideaObj = _.find(app.userVotes, {
                        'id': id
                    });
                    if (ideaObj != undefined) {
                        return 1
                    }
                    break;
                case 1:
                    iterationObj = _.find(app.iterationLikes, {
                        'id': id
                    });
                    if (iterationObj != undefined) {
                        return 1
                    }
                    break;
                default:
                    break;
            }


        },
        highlight: function(text) {
            var inputText = document.getElementById("inputText");
            var innerHTML = inputText.innerHTML;
            var index = innerHTML.indexOf(text);
            if (index >= 0) {
                innerHTML = innerHTML.substring(0, index) + "<span class='highlight'>" + innerHTML.substring(index, index + text.length) + "</span>" + innerHTML.substring(index + text.length);
                return innerHTML;
            }
        }



    },
    computed: {
        filteredIdeas: function() {
            let filtered = this.ideas;
            if (this.search) {
                filtered = this.ideas.filter(
                    m => m.mergedText.toLowerCase().indexOf(this.search) > -1
                );
            }
            return filtered;
        }
    },
    watch: {
        userVotes: {
            handler: function(val, oldVal) {
                Cookies.set("votes", JSON.stringify(this.userVotes));
                console.log(Cookies.get('votes'))
            },
            deep: true
        }
    }
})