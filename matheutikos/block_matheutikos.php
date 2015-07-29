<?php
class block_matheutikos extends block_base {

  public function init() {
    $this->title = get_string('matheutikos', 'block_matheutikos');
  }

  public function get_content() {
    if ($this->content !== null) {
      return $this->content;
    }

    global $DB, $USER;

    $credential = $DB->get_field("rcommon_user_credentials", 'credentials', array('euserid' => $USER->id, 'isbn' => "matheutikos4"));

    $this->content = new stdClass;
    $this->content->text = file_get_contents("http://matheutikos.dev/moodle/block/$credential");
    $this->content->footer = '<a href="http://matheutikos.dev/moodle/access/' . $credential . '" target="_blank">' . get_string('link', 'block_matheutikos') . '</a>';

    return $this->content;
  }
}
