@extends('admin.layouts.layout')

@section('title', 'Location')
@section('admin')
@section('pagetitle', __('messages.Location'))
<x-google-location-picker latitude="{{ old('latitude', $location->latitude ?? '') }}"
    longitude="{{ old('longitude', $location->longitude ?? '') }}"
    address="{{ old('address', $location->address ?? '') }}"
    fieldName="location" />
    @endsection
