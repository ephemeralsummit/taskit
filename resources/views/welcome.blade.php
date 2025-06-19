<x-layout><br><br><br>
    <div class="container mx-auto" style="margin-top:18vh">
        <div class="mt-lg-5">
            <p class="mb-0 text-white text-center mb-2" style="font-size: 65px">TaskIt!</p>
            <p class="h4 mb-0 text-white text-center mb-lg-5">Your To-do list companion.</p>
            @guest
            <div class="d-flex justify-content-center">
                <a href="/login" class="btn read-more-btn me-2">Login</a>
                <a href="/register" class="btn read-more-btn">Register</a>
            </div>
            @endguest
            @auth
            <div class="d-flex justify-content-center">
                <a href="/dashboard" class="btn read-more-btn">Go to dashboard</a>
            </div>    
            @endauth

            <p class="mb-0 text-white text-center mb-2" style="font-size: 30px;margin-top:80px;">What do you plan to do today?</p>
            <div class="row g-4 justify-content-center" style="margin-top:30px;">
                <div class="mx-3 col-md-3 blog-content blog-card-welcome">
                    <table class="table table_custom">
                        <tr>
                            <td style="width:50px">
                                <button class="btn btn-sm text-white" type="submit" style="background-color:#da6fd5;">
                                    <i class="fa fa-lg fa-check"></i>
                                </button>
                            </td>
                            <td>
                                <span class="task-test text-white text-left">Clean the house</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mx-3 col-md-3 blog-content blog-card-welcome">
                    <table class="table table_custom">
                        <tr>
                            <td style="width:50px">
                                <button class="btn btn-sm text-white" type="submit" style="background-color:#da6fd5;">
                                    <i class="fa fa-lg fa-check"></i>
                                </button>
                            </td>
                            <td>
                                <span class="task-test text-white text-left">Cook dinner</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mx-3 col-md-3 blog-content blog-card-welcome">
                    <table class="table table_custom">
                        <tr>
                            <td style="width:50px">
                                <button class="btn btn-sm text-white" type="submit" style="background-color:#da6fd5;">
                                    <i class="fa fa-lg fa-check"></i>
                                </button>
                            </td>
                            <td>
                                <span class="task-test text-white text-left">Restock groceries</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>