@extends("Theme::problem")

@section('options')
<p style="font-size:14pt">
    <?php
        use App\Models\User;
        use Illuminate\Support\Facades\Cookie;
        use App\Plugins\Probleme\Models\Probleme;
        use App\Plugins\Probleme\Models\Solutie;

        $user = User::all()->where('auth_token', '=', Cookie::get('token'))->first();
        $problema = Probleme::all()->where('nume', '=', $problemID)->first();
        $solutii = (!is_null($user))?Solutie::all()->where('utilizator', '=', $user->Email):$problema->solutii;
    ?>
    <table class="table table-bordered">
        <thead>
            <th> Utilizator </th>
            <th> Scor </th>
        </thead>
        <tbody>
            <?php foreach($solutii as $solutie): ?>
            <tr>
                <td><?php print($solutie->user->Username); ?></td>
                <td><?php echo ($solutie->score); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</p>
@endsection