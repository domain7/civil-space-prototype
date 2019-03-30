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