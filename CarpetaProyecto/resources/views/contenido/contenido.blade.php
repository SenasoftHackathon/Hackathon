@extends('admin.admin')
@section('contenidoVue')
<template v-if="menu==0">
        <h1>Este es el contenido principal de la página</h1>
</template>
<template v-if="menu==1">
        <h2>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed nam eius architecto veritatis iste? Fugit obcaecati laborum tempore culpa facilis, sequi, sapiente, eos necessitatibus nisi laboriosam architecto? Hic, a labore.</h2>
</template>
<template v-if="menu==2">
        <sucursal></sucursal>
</template>
<template v-if="menu==3">
        <producto></producto>
</template>
<template v-if="menu==4">
        <proveedor></proveedor>
</template>
<template v-if="menu==5">
        <h2>Contenido #5</h2>
</template>
<template v-if="menu==6">
        <h2>Contenido #6</h2>
</template>
<template v-if="menu==7">
        <h2>Contenido #7</h2>
</template>
<template v-if="menu==8">
        <h2>Contenido #8</h2>
</template>
<template v-if="menu==9">
        <h2>Contenido #9</h2>
</template>
<template v-if="menu==10">
        <iva></iva>
</template>
<template v-if="menu==11">
        <h2>Contenido #11</h2>
</template>
@endsection('contenidoVue')