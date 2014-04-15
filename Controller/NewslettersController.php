<?php
App::uses('NewsletterAppController', 'Newsletter.Controller');
/**
 * Newsletters Controller
 *
 */
class NewslettersController extends NewsletterAppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Auth');

    /**
     * beforeFilter allow the user to do some actions
     *
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow(array('add'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $save = $this->Newsletter->find('count', array("conditions" => array("email" => $this->request->data['Newsletter']['email'])));
            if ($save) {
                $this->Session->setFlash(__("The newsletter has been saved."));
                return $this->redirect(
                    array('plugin' => 'newsletter', 'controller' => 'newsletters', 'action' => 'add')
                );
            } else {
                $this->Newsletter->create();
                if ($this->Newsletter->save($this->request->data)) {
                    $this->Session->setFlash(__('The newsletter has been saved.'));
                    return $this->redirect(
                        array('plugin' => 'newsletter', 'controller' => 'newsletters', 'action' => 'add')
                    );
                } else {
                    $this->Session->setFlash(__('The newsletter could not be saved. Please, try again.'));
                }
            }
        }
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->Newsletter->recursive = 0;
        $this->set('newsletters', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @param string $id ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_view($id = null)
    {
        if (!$this->Newsletter->exists($id)) {
            throw new NotFoundException(__('Invalid newsletter'));
        }
        $options = array('conditions' => array('Newsletter.' . $this->Newsletter->primaryKey => $id));
        $this->set('newsletter', $this->Newsletter->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Newsletter->create();
            if ($this->Newsletter->save($this->request->data)) {
                $this->Session->setFlash(__('The newsletter has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The newsletter could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * admin_edit method
     *
     * @param string $id ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!$this->Newsletter->exists($id)) {
            throw new NotFoundException(__('Invalid newsletter'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Newsletter->save($this->request->data)) {
                $this->Session->setFlash(__('The newsletter has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The newsletter could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Newsletter.' . $this->Newsletter->primaryKey => $id));
            $this->request->data = $this->Newsletter->find('first', $options);
        }
    }

    /**
     * admin_delete method
     *
     * @param string $id ID
     *
     * @throws NotFoundException
     * @return void
     */
    public function admin_delete($id = null)
    {
        $this->Newsletter->id = $id;
        if (!$this->Newsletter->exists()) {
            throw new NotFoundException(__('Invalid newsletter'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Newsletter->delete()) {
            $this->Session->setFlash(__('The newsletter has been deleted.'));
        } else {
            $this->Session->setFlash(__('The newsletter could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
