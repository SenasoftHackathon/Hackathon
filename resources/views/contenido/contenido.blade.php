@extends('admin.admin')
@section('contenidoVue')
<template v-if="menu==0">
        <h1>Este es el contenido principal de la página</h1>
</template>
<template v-if="menu==1">
        <sucursal></sucursal>
</template>
@endsection('contenidoVue')