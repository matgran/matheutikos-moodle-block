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

    $isbns = $DB->get_fieldset_select("rcommon_user_credentials", 'isbn', 'euserid = ?', array($USER->id));
    $isbn = max($isbns);    
    $credential = $DB->get_field("rcommon_user_credentials", 'credentials', array('euserid' => $USER->id, 'isbn' => $isbn), IGNORE_MULTIPLE);

    $this->content = new stdClass;
    $this->content->text = file_get_contents("http://school.matheutikos.com/moodle/block/$credential");
    $this->content->footer = '<a href="http://school.matheutikos.com/moodle/access/' . $credential . '" target="_blank">' . get_string('link', 'block_matheutikos') . '</a>';

    return $this->content;
  }
}
