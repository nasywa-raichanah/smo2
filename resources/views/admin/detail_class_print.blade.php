<table>
  <thead>
    <tr>
      @if ($class->type == 1 || $class->type == 3)
        <th>No</th>
      @endif
      <th>Name</th>
      <th>Contingent</th>
      <th>Place Date of Birth</th>
      <th>Sex</th>
      <th>Weight</th>
    </tr>
  </thead>
  <tbody>
    @if ($athleteClass->count())
    @if ($class->type == 1 || $class->type == 3)
      <?php $i = 0; $j = 0; ?>
    @endif
    @foreach ($athleteClass as $athlete)
    <tr>
      @if ($class->type == 1 || $class->type == 3)
      <td>
        <?php 
        $i = $i - $athlete->group;
        if ($i != 0) {
          $j++;
        }
        $i = $athlete->group;
        ?>
        Group {{ $j }}
      </td>
      @endif
      <td>{{ $athlete->athletes->athlete_name }}</td>
      <td>{{ $athlete->user->username }}</td>
      <td>{{ $athlete->athletes->birth_place }}, {{ date('d M Y', strtotime($athlete->athletes->birth_date)) }}</td>
      <td>
        @if ($athlete->athletes->sex == 0)
        M
        @else
        @if ($athlete->athletes->sex == 1)
        F
        @endif
        @endif
      </td>
      <td>{{ $athlete->athletes->weight }} Kg</td>             
    </tr>
    @endforeach
    @else
    <tr>
      <td>Athlete not found</td>
    </tr>
    @endif
  </tbody>
</table>
