<!-- nav-tabs -->
<ul class="site-sidebar-nav nav nav-tabs nav-justified nav-tabs-line" data-plugin="nav-tabs"
role="tablist">
  <li class="active" role="presentation">
    <a data-toggle="tab" href="#sidebar-userlist" role="tab">
      <i class="icon wb-chat" aria-hidden="true"></i>
    </a>
  </li>
  <li role="presentation">
    <a data-toggle="tab" href="#sidebar-activity" role="tab">
      <i class="icon wb-user" aria-hidden="true"></i>
    </a>
  </li>
</ul>

<div class="site-sidebar-tab-content tab-content">
  <div class="tab-pane fade active in" id="sidebar-userlist">
    <div>
      <div>
        <h5 class="clearfix">Objetos de Rastreo
          <div class="pull-right">
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon wb-plus" aria-hidden="true"></i>
            </a>
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon wb-more-horizontal" aria-hidden="true"></i>
            </a>
          </div>
        </h5>
        <form class="margin-vertical-20" role="search">
          <div class="input-search input-search-dark">
            <i class="input-search-icon wb-search" aria-hidden="true"></i>
            <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Buscar">
            <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
          </div>
        </form>
		<div class="list-group">
		<div id="ObjetosLista">
				
        </div>
        </div>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="sidebar-activity">
    <div>
      <div>
        <h5 class="clearfix">Geo-Cercas
          <div class="pull-right">
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon wb-plus" aria-hidden="true"></i>
            </a>
            <a class="text-action" href="javascript:void(0)" role="button">
              <i class="icon wb-more-horizontal" aria-hidden="true"></i>
            </a>
          </div>
        </h5>
        <ul class="timeline timeline-icon timeline-single timeline-simple timeline-feed" id="GeocercasLista">
		</ul>
		</div>
    </div>
  </div>

  
</div>

<div id="conversation" class="conversation">
  <div class="conversation-header">
    <a class="conversation-more pull-right" href="javascript:void(0)">
      <i class="icon wb-more-horizontal" aria-hidden="true"></i>
    </a>
    <a class="conversation-return pull-left" href="javascript:void(0)" data-toggle="close-chat">
      <i class="icon wb-chevron-left" aria-hidden="true"></i>
    </a>
    <div class="conversation-title">Mike</div>
  </div>
  <div class="chats">
    <div class="chat chat-left">
      <div class="chat-avatar">
        <a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="Edward Fletcher">
          <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="Edward Fletcher">
        </a>
      </div>
      <div class="chat-body">
        <div class="chat-content">
          <p>
            I'm just looking around.
          </p>
          <p>Will you tell me something about yourself? </p>
          <time class="chat-time" datetime="2015-06-01T08:35">8:35 am</time>
        </div>
        <div class="chat-content">
          <p>
            Are you there? That time!
          </p>
          <time class="chat-time" datetime="2015-06-01T08:40">8:40 am</time>
        </div>
      </div>
    </div>
    <div class="chat">
      <div class="chat-avatar">
        <a class="avatar" data-toggle="tooltip" href="#" data-placement="right" title="June Lane">
          <img src="https://randomuser.me/api/portraits/men/4.jpg" alt="June Lane">
        </a>
      </div>
      <div class="chat-body">
        <div class="chat-content">
          <p>
            Hello. What can I do for you?
          </p>
          <time class="chat-time" datetime="2015-06-01T08:30">8:30 am</time>
        </div>
      </div>
    </div>
  </div>
  <div class="conversation-reply">
    <div class="input-group">
      <span class="input-group-btn">
        <a href="javascript: void(0)" class="btn btn-pure btn-default icon wb-plus"></a>
      </span>
      <input class="form-control" type="text" placeholder="Say something">
      <span class="input-group-btn">
        <a href="javascript: void(0)" class="btn btn-pure btn-default icon wb-image"></a>
      </span>
    </div>
  </div>
</div>

