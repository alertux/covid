@extends('layouts.app')

@section('content')

<!-- begin:: Subheader -->
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__body">
        <div class="kt-portlet__head-label">
            <a href="{{ route('logout') }} " class="btn btn-brand pull-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="flaticon-logout"></i>{{ trans('auth.logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <div class="row img-header">
            <div class="col-3">
                <div>
                    <a href="{{route('places.index')}}">
                        <img src="{{ asset('assets/img/places.png')}}">
                        <p class="item-explain">Lugares que he visitado</p>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <a href="{{route('contacts.index')}}">
                        <img src="{{ asset('assets/img/contacts.png')}}">
                        <p class="item-explain">Agregar Contactos</p>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <a href="{{route('diagnosis.index')}}">
                        <img src="{{ asset('assets/img/diagnosis.png')}}">
                        <p class="item-explain">Auto diagnostico</p>
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <a href="{{route('report.index')}}">
                        <img src="{{ asset('assets/img/report.png')}}">
                        <p class="item-explain">Alertar</p>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- end:: Subheader -->

<div id="news_covid" style="background-color: #ffffff;">
<?php

    for($i = 0; $i < count($items); $i++) {
        if ($i % 3 == 0) {
            echo "<div class='row' style='margin: 30px 0;'>";
        }
?>
        <div class="col-4" style="text-align: center;">
            <a href="{{ $items[$i]['link'] }}" class="title">{{ str_limit($items[$i]['title'], 25) }}</a>
<?php
            echo "<p class='description'>" . $items[$i]['description'] . "</p>";

            if (isset($items[$i]['img'])) {
                echo "<img src ='" . $items[$i]['img'][1] . "' style='max-width: 100%;'/>";
            }
            else {

                echo "<img src='" . asset('assets/img/COVID-19.png') . "' style='max-width: 100%;'>";
            }
        echo "</div>";

        if ($i % 3 == 2) {
            echo "</div>";
        }
    }
?>
</div>
@endsection

@section('additional_js')
@endsection