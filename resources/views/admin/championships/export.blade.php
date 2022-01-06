<h2>
    {{$championship->name}}
</h2>
<h4>
    Tabla de posiciones
</h4>
<div class="table-responsive">
    <table class="
                    table
                    table-striped
                    table-hover
                    table-inverse
                    table-responsive
                ">
                <thead class="thead-inverse">
                    <tr class="text-center">
                        <th>Equipo</th>
                        <th>PJ</th>
                        <th>PG</th>
                        <th>PE</th>
                        <th>PP</th>
                        <th>GF</th>
                        <th>GC</th>
                        <th>PTS</th>
                        <th>GD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderedChampionshipEnrollments as $enrollment)
                    <tr>
                        <td scope="row">
                            {{ $enrollment->club->name }}
                        </td>
                        <td>
                            {{ $enrollment->matches_played() }}
                        </td>
                        <td>
                            {{ $enrollment->matches_won() }}
                        </td>
                        <td>
                            {{ $enrollment->matches_draw() }}
                        </td>
                        <td>
                            {{ $enrollment->matches_lost() }}
                        </td>
                        <td>
                            {{ $enrollment->goals_for() }}
                        </td>
                        <td>
                            {{ $enrollment->goals_against() }}
                        </td>
                        <td scope="row">
                            {{ $enrollment->points }}
                        </td>
                        <td class="text-end">
                            {{
                                $enrollment->goals_difference()
                            }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
</div>
<style>
    h2, h4 {
        text-align: center;
        width: 100%;
    }
    table {
        font-family: arial, sans-serif;
        font-size: 12px;
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #dddddd;
    }

    td, th, tr {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        text-align: center;
    }
</style>