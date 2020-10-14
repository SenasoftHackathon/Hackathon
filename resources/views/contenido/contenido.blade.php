@extends('admin.admin')
@section('contenidoVue')
<template>
    <div v-if="menu=0">
        <h1>Este es el contenido principal de la página</h1>
    </div>
</template>
@endsection('contenidoVue')