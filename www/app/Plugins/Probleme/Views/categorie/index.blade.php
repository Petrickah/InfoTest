@extends('Probleme::categorie')

@section('categorie-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 row" style="height:100%;">
                            <h4 class="card-title col-md-9" style="margin-top: 10px;">Toate Categoriile</h4>
                            <a href="categorie/adauga" class="col-md-2 btn btn-gradient-primary btn-fw" style="height:25%; margin-right:25px">Adaugare</a>
                        </div>
                        <?php
                        $categorii_per_page = 15;
                        $nr_pages = count(\App\Models\Categorie::all())/$categorii_per_page;
                        $categorii = \App\Models\Categorie::paginate($categorii_per_page);
                        ?>
                        @if($nr_pages>1)
                            <?php
                            if(!key_exists('page', $_GET)) $_GET['page'] = 1;
                            $curr_page = (isset($_GET['page']))?($_GET['page']):1;
                            ?>
                            <nav class="col-md-4">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="categorie?page=<?php echo ($curr_page==1)?$curr_page:$curr_page-1?>"><i class="mdi mdi-chevron-left"></i></a></li>
                                    @for($i = 1; $i <= $nr_pages; $i++)
                                        <li class="page-item {{$_GET['page']==$i?'active':''}}"><a class="page-link" href="categorie?page={{$i}}">{{$i}}</a></li>
                                    @endfor
                                    <li class="page-item <?php echo ($curr_page>$nr_pages)?'active':''?>"><a class="page-link" href="categorie?page=<?php echo ($curr_page==$nr_pages)?$curr_page:$curr_page+1?>"><i class="mdi mdi-chevron-right"></i></a></li>
                                </ul>
                            </nav>
                        @endif
                    </div><br>
                    <div class="table col-md-12">
                        <div class="thead row">
                            <div class="tr row col-md-12">
                                <div class="th col-md-1">Denumire</div>
                                <div class="th col-md-7">Descriere</div>
                                <div class="th col-md-2">Keywords</div>
                                <div class="th col-md-2">Optiune</div>
                            </div>
                        </div><hr><br>
                        <div class="tbody row">
                            @foreach($categorii as $categorie)
                                <div class="tr row col-md-12">
                                    <div class="td col-md-1">{{$categorie->Denumire}}</div>
                                    <div class="td col-md-7">{!! $categorie->Descriere !!}</div>
                                    <div class="td col-md-2">
                                        @php
                                            $keywords = $categorie->keyword->where('postare_slug', '=', null);
                                        @endphp
                                        <ul>
                                            @foreach($keywords as $kw)
                                                <li>{!! $kw->Keyword; !!}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="td col-md-2">
                                        <a href="/categorie/{{$categorie->Denumire}}/edit">Modifica Categorie</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
