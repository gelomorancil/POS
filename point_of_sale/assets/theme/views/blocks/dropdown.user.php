<div class="dropdown-menu pull-right dropdown-menu-scale">
  <!-- <a class="dropdown-item" ui-sref="app.inbox.list">
    <span>Inbox</span>
    <span class="label warn m-l-xs">3</span>
  </a> -->
  <!-- <a class="dropdown-item" ui-sref="app.page.profile">
    <span>Profile</span>
  </a>
  <a class="dropdown-item" ui-sref="app.page.setting">
    <span>Settings</span>
    <span class="label primary m-l-xs">3/9</span>
  </a>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" ui-sref="app.docs">
    Need help?
  </a> -->
  <button class="dropdown-item" href="" ui-sref="access.signin" id="sign-out">Sign out</button>
</div>
<script>
$(function(){
  $('#sign-out').on('click',function(){
    window.location = base_url;
    // $(document).gmLoadPage({
    //     url: 'login/service/Login_service/log_out'
    // });
  })
})
</script>
