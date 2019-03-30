<div class="modal fade" id="iterate-idea-modal" v-observe-visibility="iterationModalVisibility">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal"> <span>×</span> </button>
            </div>
            <div class="modal-body p-5">
                    <h5>You said No to:</h5>
                    <h4 class="modal-title mb-3 ">{{modalTitle}}</h4>
                    <h5 class="mb-2">What one thing would you change to make this an idea you could say Yes to?</h5>
                    <form>
                        <div class="form-group"><textarea class="form-control" rows="5" v-model='comment'></textarea></div>
                        <!-- <input type='hidden' v-model='id' value='modalID'> -->
                    </form>
                    <p class="p-0">
                        <strong>Other suggestions:</strong>
                    </p>
                <div class="container">
                    <div v-if="iterations.length">
                      <div class="row border-top border-bottom py-2 align-items-center" v-for="iteration in iterations">
                          <div class="col-md-9 col-auto mr-auto pl-0">
                              <label><small><span class="pr-2">3 hours ago </span><strong>{{iteration.username}}</strong></small></label>
                              <p> {{iteration.comment}} </p>
                          </div>
                          <div class="col-md-2 col-auto">
                              <div class="row no-gutters align-items-center">
                                  <div class="col-9"><a class="btn btn-outline-primary btn-block btn-lg" @click.stop="likeIteration(iteration.id,iteration.idea_id)"><i class="fa fa-fw fa-thumbs-up"></i></a></div>
                                  <div class="col-3 text-center">
                                      <span class="label">{{iteration.likes}}</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div v-else>
                      <div class="row border-top border-bottom py-2 align-items-center">
                            <div class="col-12 pl-0">
                                <p>There are no iterations to this idea.</p>
                            </div>
                      </div>
                    </div>
                    <div class="row mt-4 text-center justify-content-center">
                        <div class="col-sm-6 col-lg-4">
                            <button type="button" class="btn btn-primary btn-md btn-block mb-2"  value='Add' @click='newIteration();'>Submit Your Idea</button>
                            <button type="button" class="btn btn-link" data-dismiss="modal">Skip</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>