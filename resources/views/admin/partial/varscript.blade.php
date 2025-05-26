<script>
        var loginUrl = '{{ route('backend.postlogin') }}';
        var dashboardUrl = '{{ route('dashboard') }}';
        var getDesaWisataUrl = '{{ config('desawisata.DESAWISATA_LIST') }}';

        var storeDesaWisataProfilUrl = '{{ route('desawisata.storeprofile') }}';
        var storeDesaWisataPengelolaUrl = '{{ config('desawisata.DESAWISATA_STORE_PENGELOLA') }}';
        var storeDesaWisataAtraksiUrl = '{{ config('desawisata.DESAWISATA_STORE_ATRAKSI') }}';
        var storeDesaWisataAksesUrl = '{{ config('desawisata.DESAWISATA_STORE_AKSES') }}';
        var storeDesaWisataPromosiUrl = '{{ config('desawisata.DESAWISATA_STORE_PROMOSI') }}';
</script>
