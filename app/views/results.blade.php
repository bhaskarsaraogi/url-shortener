@extends('layouts.master')

@section('container')
<h1> Here is your short Url. </h1> 
{{ HTML::link($shortened, "localhost/urlsh/$shortened")}}
@stop