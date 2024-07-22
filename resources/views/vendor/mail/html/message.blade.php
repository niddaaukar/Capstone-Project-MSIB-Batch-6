<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
<img src="https://i.ibb.co.com/7Vzzfs7/otorent.png" alt="otorent" border="0" style="width:120px;">
</x-mail::header>
</x-slot:header>

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} ANKAVI TEAM @lang(' Kelompok 5 MSIB Fullstack #4.')
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
