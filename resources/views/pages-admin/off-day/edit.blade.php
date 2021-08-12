@extends('layout.admin')
@section('title','Admin | Designation Create')
@section('styles')
    <style>
        .form-control{
            font-size: 20px;
        }
    </style>
@stop
@section('contentBody')
  <div class="card">
        <div class="card-header">
            <h2>Off Day
             <a href="{{ url('offday/month') }}"> <span class="pull-right btn btn-primary custom-btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> back </span></a> </h2>
        </div>
        <div class="card-body card-padding">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center"> 
                <form role="form" method="post" action="{{ action("OffdayController@update") }}" class="remove-margin-p">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                    <?php
                
                            # PHP Calendar (version 2.3), written by Keith Devens

                        function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array()) {
                            $first_of_month = gmmktime(0, 0, 0, $month, 1, $year);

                            #remember that mktime will automatically correct if invalid dates are entered
                            # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
                            # this provides a built in "rounding" feature to generate_calendar()

                            $day_names = array(); #generate all the day names according to the current locale
                            for ($n = 0, $t = (3 + $first_day) * 86400; $n < 7; $n++, $t+=86400) #January 4, 1970 was a Sunday
                                $day_names[$n] = ucfirst(gmstrftime('%A', $t)); #%A means full textual day name

                            list($month, $year, $month_name, $weekday) = explode(',', gmstrftime('%m,%Y,%B,%w', $first_of_month));
                            $weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day
                            $title = htmlentities(ucfirst($month_name)) . '&nbsp;' . $year;  #note that some locales don't capitalize month and day names
                            #Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
                            @list($p, $pl) = each($pn);
                            @list($n, $nl) = each($pn); #previous and next links, if applicable
                            if ($p)
                                $p = '<span class="calendar-prev">' . ($pl ? '<a href="' . htmlspecialchars($pl) . '">' . $p . '</a>' : $p) . '</span>&nbsp;';
                            if ($n)
                                $n = '&nbsp;<span class="calendar-next">' . ($nl ? '<a href="' . htmlspecialchars($nl) . '">' . $n . '</a>' : $n) . '</span>';
                            $calendar = '<table class="calendar table-condensed">' . "\n" .
                                    '<caption class="calendar-month">' . $p . ($month_href ? '<a href="' . htmlspecialchars($month_href) . '">' . $title . '</a>' : $title) . $n . "</caption>\n<tr>";

                            if ($day_name_length) { #if the day names should be shown ($day_name_length > 0)
                                #if day_name_length is >3, the full name of the day will be printed
                                foreach ($day_names as $d)
                                    $calendar .= '<th abbr="' . htmlentities($d) . '">' . htmlentities($day_name_length < 4 ? substr($d, 0, $day_name_length) : $d) . '</th>';
                                $calendar .= "</tr>\n<tr>";
                            }

                            if ($weekday > 0)
                                $calendar .= '<td colspan="' . $weekday . '">&nbsp;</td>';#initial 'empty' days
                            for ($day = 1, $days_in_month = gmdate('t', $first_of_month); $day <= $days_in_month; $day++, $weekday++) {
                                if ($weekday == 7) {
                                    $weekday = 0; #start a new week
                                    $calendar .= "</tr>\n<tr>";
                                }
                                if (isset($days[$day]) and is_array($days[$day])) {
                                    @list($link, $classes, $content) = $days[$day];
                                    if (is_null($content))
                                        $content = $day;
                                    $calendar .= '<td' . ($classes ? ' class="' . htmlspecialchars($classes) . '">' : '>') .
                                            ($link ? '<a href="' . htmlspecialchars($link) . '">' . $content . '</a>' : $content) . '</td>';
                                } else
                                    $calendar .= "<td id='{$day}'>$day</td>";
                            }
                            if ($weekday != 7)
                                $calendar .= '<td colspan="' . (7 - $weekday) . '">&nbsp;</td>';#remaining "empty" days

                            return $calendar . "</tr>\n</table>\n";
                        }

                            echo generate_calendar($offday -> year, $offday -> month, 16, 3, NULL, 0, 15);
                            #echo generate_calendar($year, $month, $days,$day_name_length,$month_href,$first_day,$pn);
            
                    ?>
            </div>
       </div>             
                    <input type="hidden" name="off_days" value="">
                    <input type="hidden" name="year" value="{{ $offday -> year}}">
                    <input type="hidden" name="month" value="{{ $offday -> month}}">
                    <button type="button" class="btn btn-primary btn-sm m-t-10" onclick="submit_2();">Update</button>
                </form>
            </div>
        </div>   
        </div>
    </div>

@endsection

@section('scripts')
    <script>

            var off_day = [];

            $("td").click(function () {

               
                var i = ("#" + this.id);
                if ($.inArray(this.id, off_day) > -1) {
                    // remove
                    
                    off_day.splice($.inArray(this.id, off_day), 1);

                    $(i).css({"background-color": "#fff", "color": "black"});
                } else {
                    //add
                    off_day.push(this.id);
                    $(i).css({"background-color": "#f9406c", "color": "black"});
                }

               // alert(off_day);

               



            });


            function submit_2() {

                var off_day_list = "";
                var array_len = off_day.length;
                for (o in off_day) {
                    if (off_day_list !== "") {
                        off_day_list += "," + off_day[o];
                    } else {
                        off_day_list += off_day[o];
                    }
                   
                }

                // alert(off_day_list);
                var csfr = $('[name="_token"]').val();
                var year = $('[name="year"]').val();
                var month =$('[name="month"]').val();

                if ( month == "" ) 
                {
                    alert('Month is Required');
                }
                else if( year == "" ){
                    alert('Year is Required');
                }
                else if( off_day_list == "" )
                {
                    alert('Day is Required');
                }


                else{
                    var dt = {
                    _token: csfr, 
                    off_days: off_day_list,
                    month: month ,
                    year: year
                };
				var url = location.origin+'/offday/update';
				var urlBack = location.origin+'/offdayview';
                    $.post( url, dt)
                        .done(function( data ) {
                        alert( data );
						window.location.href = urlBack;
                    });
                }
                



            }
        </script>

@stop