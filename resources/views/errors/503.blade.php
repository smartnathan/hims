  @extends('layouts.error')
  @section('content')
   <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>503</h1>
                <h3 class="text-uppercase">SITE WILL BE UP IN FEW MINUTES!</h3>
                <p class="text-muted m-t-30 m-b-30">Please, try after some time</p>
                <a href="{{ url('/')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
            <footer class="footer t-a-c"> &copy; {{ date('Y') }}. Powered by <a href="https://kodehauz.com" target="_blank">KodeHauz Solution Planet</a>
</footer>
        </div>
    </section>
  @endsection
