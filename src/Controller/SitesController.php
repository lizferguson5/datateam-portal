<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;

/**
 * Sites Controller
 *
 * @property \App\Model\Table\SitesTable $Sites
 */
class SitesController extends AppController
{

    /**
     * isAuthorized method
     */
    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['edit'])) {
            return true;
        }        
        return parent::isAuthorized($user);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index($region=null) {
      $query = $this->Sites->find('all');
      if ($region) {
        $query->where(['parent_region'=>$region]);
      }
      $this->set('sites',$this->paginate($query));
      $this->set('_serialize', 'sites');
    }

    /**
     * View method
     *
     * @param string|null $id Site id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
      $query = $this->Sites->find()
        ->where(['Sites.reference_designator'=>$id])
        ->contain(['Regions','Nodes','Nodes.Instruments','Notes.Users','Deployments']);
      $site = $query->first();
      
      if (empty($site)) {
          throw new NotFoundException(__('Site not found'));
      }

      $this->set('site', $site);
      $this->set('_serialize', ['site']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Site id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $query = $this->Sites->find()
          ->where(['Sites.reference_designator'=>$id])
          ->contain(['Regions']);
        $site = $query->first();
        
        if (empty($site)) {
            throw new NotFoundException(__('Site not found'));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $site = $this->Sites->patchEntity($site, $this->request->data, [
                'fieldList'=>['latitude','longitude','bottom_depth','current_status']
            ]);
            if ($this->Sites->save($site)) {
                $this->Flash->success(__('The site has been updated.'));
                return $this->redirect(['action' => 'view', $site->reference_designator]);
            } else {
                $this->Flash->error(__('The site could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('site'));
        $this->set('_serialize', ['site']);
    }

}
