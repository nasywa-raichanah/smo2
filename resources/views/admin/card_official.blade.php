<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
  <link rel="icon" type="image/png" href="{{ asset('style/TheEvent/assets/img/logo.png') }}">
  <title class="text-uppercase">
    SMC XII - {{ $title }}
  </title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('style/board/css/card-official.css') }}" />
</head>

<body>
  <div class="container ">
      <div class="padding">
        <div class="font" style="background-image: url({{ asset('images/systems/official_card.png') }}); background-size: 343px 493px;">
          <div class="photo">
            <img src="{{ asset('images/teams/managers/'. $manager->manager_photo) }}" alt="" />
          </div>
          <div class="ename">
            <p>
              <b>{{ $manager->manager_name }}</b>
            </p>
          </div>
          <div class="eteam">
            <p>
              <b>{{ $manager->user->username}}</b>
            </p>
          </div>
        </div>
      </div>
    </div>

<script>
    window.print();
</script>
</body>
</html>