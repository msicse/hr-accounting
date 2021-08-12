@extends('layout.master')
@section('title','| Contact')

@section('content')
  <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Contact Me</h3>
            </div>
            <div class="panel-body">
                <form>
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input type="text" name="subject" class="form-control" id="pwd">
                  </div>
                  <div class="form-group">
                      <label for="message">Message:</label>
                      <textarea class="form-control" rows="5" name="message" id="message" placeholder="type your message here"></textarea>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                  </div>
                  <button type="submit" class="btn btn-success">Send Message</button>
                </form>
            </div>
          </div>
        </div>
    </div><!--end of content row-->
@endsection