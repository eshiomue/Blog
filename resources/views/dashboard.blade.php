<x-main-layout>

    <div class="container">
        <div class="row">
            @if(Session::has('message'))
                    <b><span style="margin-bottom: 30px; color: red;">{{Session::get('message')}}</span>
                @endif
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

             <table class="table table-striped" cellpadding="10">
			    <tr style="font-weight: bold;">
                    <td> Number </td>
                    <td> User </td>
                    <td> Post </td>
                    <td>Picture</td>
                    <td colspan="2">Manage</td>
            	</tr>
                 <?php $count = 0; ?>
               
		    </table>
           
            </div>
        </div>
    </div>
</x-main-layout>

<style>
    .alert {
        font-size: 1rem;
        font-weight: 500;
        border-radius: 0.5rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        width: 17%;
        max-width: 800px;
        margin: 0 auto;
    }
</style>
