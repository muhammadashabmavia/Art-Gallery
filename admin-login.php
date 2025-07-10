<?php include 'include/loginheader.php'; ?>
<div class="container" id="container">
    <div class="row">
    <div class="form-container sign-in-admin">
		<form action="./admin.php">
			<h1>Sign in</h1>
			<span>or use your account</span>
			<input type="email" placeholder="Email" required>
			<input type="password" placeholder="Password"  required>
			<a href="#">Forgot your password?</a>
			<button>Sign In</button>
		</form>
	</div>
    </div>
</div>

<?php include 'include/footer.php'; ?>