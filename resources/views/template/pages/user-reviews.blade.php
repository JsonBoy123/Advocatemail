<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div class="row">

    <div class="col-md-11 m-auto" id="writeReviewBox">
      <hr>
      <h3>Submit Review</h3>
      <form>
        @csrf
        <div class="row form-group">
          <div class="col-md-12">
            <input type="hidden" name="user_id" id="user_id" value = "{{$userData->id}}">
            <input type="hidden" name="guest_id" value = "{{Auth::user() ? Auth::user()->id:''}}">
            <input id="ratings-hidden" name="rating" type="hidden"> 
            <textarea class="form-control animated" cols="40" rows="5" id="review_text" name="review_text" placeholder="{{Auth::user() ? 'Enter your review here...' :'If want to write here so login first'}} " required   {{Auth::user() ? '' :'readonly'}}></textarea>
            @error('review_text')
            <span class="text-danger" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-12 mt-2">
           <div class="my-rating mb-2">
            <span>Working Star Ratings for {{$userData->name.' '.$userData->mid_name.' '.$userData->last_name }}</span>&nbsp;&nbsp;&nbsp;
            <span class="my-rating-9"></span>
            <span class="live-rating"></span>
          </div> 
          @if(Auth::user()) 
          <button class="btn text-success border-success btn-sm font-weight-bold" type="submit" style="font-size: 12px" id="review_submit">Submit</button>
          @else
          <button type="button" class="btn text-success border-success btn-sm font-weight-bold" id="writeReview">Submit</button>
          @endif
          <a class="btn text-danger border-danger btn-sm font-weight-bold"  id="cancelWR" style="margin-right: 10px; color: #fff;font-size: 12px">
            Cancel <i class="fa fa-remove"></i></a>
          </div>

        </div>
      </form>
    </div>

    <br>          
  </div>

  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
     <h3>Top Reviews</h3>
     @foreach($reviews as $review)
     <div class="review-list">
      <div class="review-item">
       <div class="media">
        <a class="pull-left" href="#">
          <span class="d-inline-block text-info border-info text-center font-weight-bold p-2" style="border:1px solid;"><div class="review-timestamp"><i>{{date('M d, Y', strtotime($review->review_date))}}</i></div></span>
        </a>
        <i class="fa fa-caret-left fa-4x" style="color: #ececec!important;"></i>
        <div class="media-body d-table-cell mb-1" style="background-color: #ececec!important; border-radius: 20px;">
          <span class="name"><b>{{$review->customers->name}} - </b></span>
          <span class="verified"><i class="text-info">Verified Client</i></span>
          <span class="star-rating m-4">

            <?php $rating = $review->review_rate; ?>

            @for($i=1;$i<= floor($rating);$i++)

            <i class="fa fa-star" style="color:chocolate"></i>

            @endfor

            @if(substr($rating, strpos($rating, ".") + 1)==5)
            <i class="fa fa-star-half" style="color:chocolate"></i>
            @elseif($rating != 5.0 || $rating==null)
            <i class="fa fa-star" style="color:chocolate"></i>

            @endif
            @for($i=1;$i<=(4-floor($rating));$i++)

            <i class="fa fa-star" style="color:chocolate"></i>

            @endfor

          </span>
          <div class="review-content mb-2">{{$review->review_text}}</div>
          
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
</div>
<div class="mb-4"></div>
{!! $reviews->links() !!}
<script>
  $(".my-rating-9").starRating({
    starSize: 20,
    disableAfterRate: false,
    onHover: function(currentIndex, currentRating, $el){
      $('.live-rating').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      $('.live-rating').text(currentRating);
    }
  });
</script>
</body>
</html>
