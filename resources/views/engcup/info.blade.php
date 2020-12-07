<!doctype html>
<html lang="en">
<head>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<section class="a">
    <div class="container my-0">
        @if ($alert)
            <div class="container my-0">
                <div class="alert alert-danger" role="alert">
                    Data has already generated <a href="/results/truncate" class="alert-link">Would you like to clear
                        out</a>.
                    Give it a click if you like.
                </div>
            </div>
        @endif
    </div>
    @if (!@empty($buttonPlayOff))
        <div class="container my-1">
            <div class="row">
                <div class="table-responsive col-md-6">
                    <table class="table table-bordered table-inverse">
                        <thead>
                        <tr>
                            <th>PremierLeague</th>
                            @foreach ($divisionChampionship as $d)
                                <th>{{$d->team_name}}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($championShip as $i =>$d)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                @foreach ($d as $res)
                                    <th style="text-align: center">{{ $res }}</th>
                                @endforeach
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="table-responsive col-md-6">
                    <table class="table table-bordered table-inverse">
                        <thead>
                        <tr>
                            <th>ChampionShip</th>
                            @foreach ($divisionPrimerLeague as $p)
                                <th>{{$p->team_name}}</th>
                            @endforeach
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($premierLeague as $i =>$d)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                @foreach ($d as $res)
                                    <th style="text-align: center">{{ $res }}</th>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</section>
<section class="b">
    <div class="container my-2">
        <div class="row">
            @if (!empty(count($quarter) > 0))
                <div class="col">
                    <h4 style="text-align: center">1/4</h4>
                </div>
            @endif
        </div><!--/row-->
    </div><!--container-->
    <div class="container my-3">
        <div class="row">
            @foreach ($quarter as $q)
                <div class="col">
                    <h6 style="text-align: center">{{ $divisions->firstWhere('id', $q->team_first)->team_name }} {{$q->scored_team_first}}
                        - {{$q->scored_team_second}} {{ $divisions->firstWhere('id', $q->team_second)->team_name }}</h6>
                </div>
            @endforeach
        </div><!--/row-->
    </div><!--container-->
    <div class="container my-4">
        <div class="row">
            @if (!empty(count($semiFinal) > 0))
                <div class="col">
                    <h4 style="text-align: center">1/2</h4>
                </div>
            @endif
        </div><!--/row-->
    </div><!--container-->
    <div class="container my-5">
        <div class="row">
            @foreach ($semiFinal as $s)
                <div class="col">
                    <h6 style="text-align: center">{{ $divisions->firstWhere('id', $s->team_first)->team_name }} {{$s->scored_team_first}}
                        - {{$s->scored_team_second}} {{ $divisions->firstWhere('id', $s->team_second)->team_name }}</h6>
                </div>
            @endforeach
        </div><!--/row-->
    </div><!--container-->
    <div class="container my-6">
        <div class="row">
            @if (!empty(count($final) > 0))
                <div class="col">
                    <h4 style="text-align: center">Final</h4>
                </div>
            @endif
        </div><!--/row-->
    </div><!--container-->
    <div class="container my-7">
        <div class="row">
            @foreach ($final as $f)
                <div class="col">
                    <h6 style="text-align: center">{{ $divisions->firstWhere('id', $f->team_first)->team_name }} {{$f->scored_team_first}}
                        - {{$f->scored_team_second}} {{ $divisions->firstWhere('id', $f->team_second)->team_name }}</h6>
                </div>
            @endforeach
        </div><!--/row-->
    </div><!--container-->
</section>
<section class="c">
    <div class="container my-8">
        <a href="/results/group" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Генерация
            групповой
            стадии</a>
        @if (!@empty($buttonPlayOff))
            <a href="/results/playoff" class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">Генерация
                плей-офф</a>
        @endif
        <a href="/results/truncate" class="btn btn-primary btn-lg btn-block" role="button" aria-pressed="true">Очистить
            все
            результаты</a>
    </div>
</section>
<section class="d">
    <div class="container my-9">
    </div>
</section>
<script src="/js/app.js"></script>
</body>
</html>
