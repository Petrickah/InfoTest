@extends('Probleme::articol')

@section('articol-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-md-8" style="margin-top: 5px;">Toate Solutiile</h4>
                        <?php
                        $solutii_per_page = 15;
                        $nr_pages = count(\App\Plugins\Probleme\Models\Solutie::all())/$solutii_per_page;
                        $solutii = \App\Plugins\Probleme\Models\Solutie::paginate($solutii_per_page);
                        ?>
                        @if($nr_pages>1)
                            <?php
                            if(!key_exists('page', $_GET)) $_GET['page'] = 1;
                            $curr_page = (isset($_GET['page']))?($_GET['page']):1;
                            ?>
                            <nav class="col-md-4">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="articol?page=<?php echo ($curr_page==1)?$curr_page:$curr_page-1?>"><i class="mdi mdi-chevron-left"></i></a></li>
                                    @for($i = 1; $i <= $nr_pages; $i++)
                                        <li class="page-item {{$_GET['page']==$i?'active':''}}"><a class="page-link" href="articol?page={{$i}}">{{$i}}</a></li>
                                    @endfor
                                    <li class="page-item <?php echo ($curr_page>$nr_pages)?'active':''?>"><a class="page-link" href="articol?page=<?php echo ($curr_page==$nr_pages)?$curr_page:$curr_page+1?>"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th> Problema </th>
                                <th> Student </th>
                                <th> Scor </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($solutii as $solutie)
                                <tr>
                                    <td> {{$solutie->problema}} </td>
                                    <td> {{$solutie->user->Username}} </td>
                                    <td> {{$solutie->score}} </td>
                                    <td><a href="/problema/{{$solutie->probleme->slug}}/">Vezi problema</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
