<template>
    <v-app>
        <v-container>
           <v-navigation-drawer v-model="drawer" mini-variant permanent app>
              <v-list>
                <v-menu offset-x>
                  <template v-slot:activator="{ on, attrs }">
                    <v-avatar size="53" color="#E0F2F1" class="mx-auto">
                      <v-btn size="small" icon v-bind="attrs" v-on="on">
                         <v-icon>fas fa-plus</v-icon>
                      </v-btn>
                    </v-avatar>
                  </template>
                  <v-list>
                    <v-list-item link>
                      <v-list-item-title>予定</v-list-item-title>
                    </v-list-item>
                    <v-list-item link @click="showTaskResister()">
                      <v-list-item-title>タスク</v-list-item-title>
                    </v-list-item>
                    <v-list-item link @click="showMemoResister()">
                      <v-list-item-title>メモ</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
                <v-list-item>
                  <v-list-item-title>
                    <v-icon>far fa-calendar-alt</v-icon>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item>
                  <v-list-item-title>
                    <v-icon>far fa-check-square</v-icon>
                  </v-list-item-title>
                </v-list-item>
                <v-list-item @click="showMemoResister()">
                  <v-list-item-title>
                    <v-icon>far fa-edit</v-icon>
                  </v-list-item-title>
                </v-list-item>
              </v-list>
            </v-navigation-drawer>
            <v-row justify="space-around">
              <v-col v-for="task in tasks" :key="task" cols="5" md="4">
                <v-card class="mb-5">
                  <v-card-item>
                    <div>
                      <div class="text-overline mb-1">カテゴリ</div>
                      <div v-text="task.title" class="text-h6 mb-1"></div>
                      <div v-text="task.text" class="text-caption"></div>
                    </div>
                  </v-card-item>
                  <v-card-actions>
                    <v-btn @click="showEditTask(task)" variant="outlined">編集</v-btn>
                    <v-btn @click="deleteTask(task.id,index)" variant="outlined">削除</v-btn>
                  </v-card-actions>
                </v-card>
              </v-col>
            </v-row>
        </v-container>
        <v-container fill-height justify="center" style="width: 500px;" class="ma-auto">
          <v-card class="py-12 px-5" >
            <v-card-title>カテゴリ登録</v-card-title>
            <v-form>
              <v-col cols="12">
                <v-text-field
                  label="名前"
                  name="name"
                  type="text"
                  v-model="categoryName"
                />
              </v-col>
            </v-form>
            <v-btn @click="createNewCategory()" color="#66BB6A" class="mx-2">登録</v-btn>
          </v-card>
        </v-container>
        <v-container fill-height justify="center" style="width: 500px;" class="ma-auto" v-if="taskResister">
          <v-card class="py-12 px-5" >
                <v-card-title>タスク登録</v-card-title>
                    <v-form>
                      <v-col cols="12">
                        <v-text-field
                          label="タイトル"
                          name="title"
                          type="text"
                          v-model="taskTitle"
                        />
                      </v-col>
                      <v-col cols="12">
                        <v-select :items="categories" label="カテゴリ" item-title="name" item-value="id" v-model="selectedCategory"></v-select>
                      </v-col>
                      <v-col cols="12">
                        <v-textarea
                          label="テキスト"
                          name="text"
                          type="text"
                          v-model="taskText"
                        />
                      </v-col>
                    </v-form>
                <v-row justify="center">
                  <v-btn @click="closeTaskResister()" color="#B0BEC5" class="mx-2">キャンセル</v-btn>
                  <v-btn @click="createNewTask()" color="#66BB6A" class="mx-2">登録</v-btn>
                </v-row>
          </v-card>
        </v-container>
        <v-card>
            <v-list>
                <!--<v-list-itemv-for="task in tasks">-->
                <!--    <v-text>{{ task.name }}</v-text>-->
                <!--    <v-text>{{ task.category }}</v-text>-->
                <!--    <v-text>{{ task.text }}</v-text>-->
                <!--</v-list-item>-->
            </v-list>
        </v-card>
        </v-container>
    </v-app>
    
</template>
<script>
    export default {
        data: function() {
            return{
                drawer: true,
                taskResister: false,
                tasks: {},
                taskTitle: "",
                taskText: "",
                taskId: "",
                categories: {},
                categoryName: "",
                categoryId: "",
                selectedCategory: ""
            };
        },
        methods: {
            createNewCategory: function(){
              axios.post('/api/categories', {name:this.categoryName})
              .then((response) => {
                console.log(response);
              })
              .catch((error) => {
                console.log(error);
              });
            },
            showTaskResister: function(){
                this.taskResister = true;
            },
            closeTaskResister: function(){
                this.taskResister = false;
            },
            createNewTask:function(){
              // console.log(this.selectedCategory);
                axios.post('/api/tasks', {title:this.taskTitle, text:this.taskText, category_id:this.selectedCategory})
                .then((response) => {
                  console.log(response);
                })
                .catch((error) => {
                  console.log(error);
                });
            }
        },
        mounted: function() {
            // データを取得表示
            let self = this;
            axios
            .get('/api/categories')
            .then(function(response){
                self.categories = response.data;
            });
            
            axios
            .get('/api/tasks')
            .then(function(response){
                self.tasks = response.data;
            });
        }
    }
</script>