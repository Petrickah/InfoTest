@extends("UserRoles::index")

@section('utilizatori-section')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h4 class="card-title col-md-8" style="margin-top: 5px;">Toti utilizatorii</h4>
                        <?php

                        use App\Models\User;

                        $users_per_page = 15;
                        $nr_pages = count(User::all())/$users_per_page;
                        $users = User::paginate($users_per_page);
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
                                <th> Email </th>
                                <th> Username </th>
                                <th> Nume </th>
                                <th> Prenume </th>
                                <th> Role </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td> {{$user->Email}} </td>
                                    <td> {{$user->Username}} </td>
                                    <td> {{$user->Nume}} </td>
                                    <td> {{$user->Prenume}} </td>
                                    <td> {{$user->role[0]->role}} </td>
                                    <td><a href="/utilizator/{{$user->Username}}">Modifica utilizator</a></td>
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