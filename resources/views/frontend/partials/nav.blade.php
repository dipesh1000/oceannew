<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"
            >&times;</a
        >
        <a href="{{ URL::to('/') }}">Home</a>
        <a href="/about-us">About us</a>
        <a href="{{ route('categoryType') }}">Packages</a>
        <a href="{{ route('categoryType') }}">Product</a>
        {{-- <a href="{{ route('dristibuter') }}">Distibuter</a> --}}
        <a href="{{ route('getContact') }}">Contact</a>
        <a href="">Register</a>
    </div>
    <div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.login') }}" method="POST">
                        <div class="form-group">
                        <label for="">User Name</label>
                        <input type="text" name="email" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="*********">
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn signin">Login</button>
                        </div>
                        
    
                    </form>
                    <div class="social-login">
                        <ul>
                            <li>
                                <input type="checkbox">
                                <label for="">Save Password</label>
                            </li>
                            <li class="forget_password">
                            <a href="">Forget Password?</a> 
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                <div class="no_account">
                    Haven't Any Account? <a href="register.html">Click here</a>
                </div>
                </div>
            </div>
        </div>
    </div>
    
    