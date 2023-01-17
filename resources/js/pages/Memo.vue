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
                <v-list-item link>
                  <v-list-item-title>タスク</v-list-item-title>
                </v-list-item>
                <v-list-item link @click="showMemoRegister()">
                  <v-list-item-title>メモ</v-list-item-title>
                </v-list-item>
              </v-list>
            </v-menu>
            <v-list-item>
              <v-list-item-title>
                <router-link to="/calendar">
                  <v-icon>far fa-calendar-alt</v-icon>
                </router-link>
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title>
                <router-link to="/calendar/task">
                  <v-icon>far fa-check-square</v-icon>
                </router-link>
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title>
                <router-link to="/calendar/memo">
                  <v-icon>far fa-edit</v-icon>
                </router-link>
              </v-list-item-title>
            </v-list-item>
          </v-list>
        </v-navigation-drawer>
      <v-container fluid>
        <v-row >
          <v-col v-for="memo in memos" :key="memo.memo_id" cols="5" md="4">
            <v-card class="mb-5">
              <v-app-bar flat color="rgba(0, 0, 0, 0)">
                <v-toolbar-title v-text="memo.title" class="text-h7"></v-toolbar-title>
                <v-spacer></v-spacer>
                <v-menu offset-x>
                  <template v-slot:activator="{ on, attrs }">
                    <!--<v-avatar size="53" color="#E0F2F1" class="mx-auto">-->
                    <!--  <v-btn size="small" icon v-bind="attrs" v-on="on">-->
                    <!--     <v-icon>fas fa-plus</v-icon>-->
                    <!--  </v-btn>-->
                    <!--</v-avatar>-->
                    <v-btn color="#5f5f5f" icon v-bind="attrs" v-on="on">
                      <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                  </template>
                  <v-list>
                    <v-list-item link @click="showEditMemo(memo)">
                      <v-list-item-title>編集</v-list-item-title>
                    </v-list-item>
                    <v-list-item link @click="deleteMemo(memo.id,index)">
                      <v-list-item-title>削除</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </v-app-bar>
                <!--<v-card-title v-text="memo.title" class="text-h7"></v-card-title>-->
                <v-card-text v-text="memo.text" class="text-caption"></v-card-text>
              <!--<v-card-actions>-->
              <!--  <v-btn @click="showEditMemo(memo)" variant="outlined">編集</v-btn>-->
              <!--  <v-btn @click="deleteMemo(memo.id,index)" variant="outlined">削除</v-btn>-->
              <!--</v-card-actions>-->
            </v-card>
          </v-col>
        </v-row>
      </v-container>
      <!--<v-container fill-height justify="center" style="width: 500px;" class="ma-auto" v-if="memoResister">-->
      <!--  <v-card class="py-12 px-5" >-->
      <!--    <v-card-title>メモ登録</v-card-title>-->
      <!--      <v-form>-->
      <!--        <v-col cols="12">-->
      <!--          <v-text-field-->
      <!--            label="タイトル"-->
      <!--            name="title"-->
      <!--            type="text"-->
      <!--            v-model="memoTitle"-->
      <!--          />-->
      <!--        </v-col>-->
      <!--        <v-col cols="12">-->
      <!--          <v-textarea-->
      <!--            label="テキスト"-->
      <!--            name="text"-->
      <!--            type="text"-->
      <!--            v-model="memoText"-->
      <!--          />-->
      <!--        </v-col>-->
      <!--      </v-form>-->
      <!--    <v-row justify="center">-->
      <!--      <v-btn @click="closeMemoResister()" color="#B0BEC5" class="mx-2">キャンセル</v-btn>-->
      <!--      <v-btn @click="createNewMemo()" color="#66BB6A" class="mx-2">登録</v-btn>-->
      <!--    </v-row>-->
      <!--  </v-card>-->
      <!--</v-container>-->
      <!--  <v-container fill-height justify="center" style="width: 500px;" class="ma-auto" v-if="editMemo">-->
      <!--  <v-card class="py-12 px-5" >-->
      <!--    <v-card-title>メモ編集</v-card-title>-->
      <!--    <v-form>-->
      <!--      <v-col cols="12">-->
      <!--        <v-text-field-->
      <!--          label="タイトル"-->
      <!--          name="title"-->
      <!--          type="text"-->
      <!--          v-model="memoTitle"-->
      <!--          ref="editor"-->
      <!--        />-->
      <!--      </v-col>-->
      <!--      <v-col cols="12">-->
      <!--        <v-textarea-->
      <!--          label="テキスト"-->
      <!--          name="text"-->
      <!--          type="text"-->
      <!--          v-model="memoText"-->
      <!--          ref="editor"-->
      <!--        />-->
      <!--      </v-col>-->
      <!--    </v-form>-->
      <!--    <v-row justify="center">-->
      <!--      <v-btn @click="closeMemoResister()" color="#B0BEC5" class="mx-2">キャンセル</v-btn>-->
      <!--      <v-btn @click="updateMemo()" color="#66BB6A" class="mx-2">更新</v-btn>-->
      <!--    </v-row>-->
      <!--  </v-card>-->
      <!--</v-container>-->
      </v-container>
      <template>
        <template>
              <v-btn color="primary" dark @click="showMemoRegister()">新規作成</v-btn>
        </template>
        <v-row justify="center">
          <v-dialog v-model="memoRegister" persistent max-width="600px">
            <v-card>
              <v-card-title>
                <span class="text-h5">メモ新規作成</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                    <v-col cols="12">
                      <v-text-field
                        label="タイトル"
                        name="title"
                        type="text"
                        v-model="memoTitle"
                        ref="editor"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="テキスト"
                        name="text"
                        type="text"
                        v-model="memoText"
                        ref="editor"
                        required
                      ></v-text-field>
                    </v-col>
                  </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn　color="blue darken-1" text @click="closeMemoRegister()">キャンセル</v-btn>
                <v-btn　color="blue darken-1" text @click="createNewMemo()">登録</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
      </template>
      <template>
        <v-row justify="center">
          <v-dialog v-model="editMemo" persistent max-width="600px">
            <v-card>
              <v-card-title>
                <span class="text-h5">編集</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                    <v-col cols="12">
                      <v-text-field
                        label="タイトル"
                        name="title"
                        type="text"
                        v-model="memoTitle"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="テキスト"
                        name="text"
                        type="text"
                        v-model="memoText"
                        required
                      ></v-text-field>
                    </v-col>
                  </v-container>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn　color="blue darken-1" text @click="closeEditMemo()">キャンセル</v-btn>
                <v-btn　color="blue darken-1" text @click="updateMemo()">更新</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </v-row>
      </template>
        <!--<v-container fill-height justify="center" style="width: 500px;" class="ma-auto">-->
        <!--  <v-card class="py-12 px-5" >-->
        <!--    <v-card-title>カテゴリ登録</v-card-title>-->
        <!--    <v-form>-->
        <!--      <v-col cols="12">-->
        <!--        <v-text-field-->
        <!--          label="名前"-->
        <!--          name="name"-->
        <!--          type="text"-->
        <!--          v-model="categoryName"-->
        <!--        />-->
        <!--      </v-col>-->
        <!--    </v-form>-->
        <!--    <v-btn @click="createNewCategory()" color="#66BB6A" class="mx-2">登録</v-btn>-->
        <!--  </v-card>-->
        <!--</v-container>-->
        
        <!--<v-container fill-height justify="center" style="width: 500px;" class="ma-auto" v-if="taskResister">-->
        <!--  <v-card class="py-12 px-5" >-->
        <!--        <v-card-title>タスク登録</v-card-title>-->
        <!--            <v-form>-->
        <!--              <v-col cols="12">-->
        <!--                <v-text-field-->
        <!--                  label="タイトル"-->
        <!--                  name="title"-->
        <!--                  type="text"-->
        <!--                  v-model="taskTitle"-->
        <!--                />-->
        <!--              </v-col>-->
        <!--              <v-col cols="12">-->
        <!--                <v-select :items="categories" label="カテゴリ" item-title="name" item-value="id" v-model="selectedCategory"></v-select>-->
        <!--              </v-col>-->
        <!--              <v-col cols="12">-->
        <!--                <v-textarea-->
        <!--                  label="テキスト"-->
        <!--                  name="text"-->
        <!--                  type="text"-->
        <!--                  v-model="taskText"-->
        <!--                />-->
        <!--              </v-col>-->
        <!--            </v-form>-->
        <!--        <v-row justify="center">-->
        <!--          <v-btn @click="closeTaskResister()" color="#B0BEC5" class="mx-2">キャンセル</v-btn>-->
        <!--          <v-btn @click="createNewTask()" color="#66BB6A" class="mx-2">登録</v-btn>-->
        <!--        </v-row>-->
        <!--  </v-card>-->
        <!--</v-container>-->
    </v-app>
    
</template>
<script>
   export default {
      data:function(){
        return{
          drawer: true,
          dialog: false,
          memoRegister: false,
          editMemo: false,
          memos: {},
          memoTitle: "",
          memoText: "",
          memoId: "",
          user: ""
        };
      },
      methods: {
        createNewMemo:function(){
          //axios.post(URL, data jsの構造体)
          axios.post('/api/memos', {title:this.memoTitle, text:this.memoText})
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            console.log(error);
          });
          // this.$router.go({path: '/calendar/memo', force: true});
        },
        deleteMemo:function(id,index){
          // console.log(this.index);
          axios.delete('/api/memos/' + id)
          .then((response) => {
            console.log(response);
            this.memos.splice(index,1);
          })
          .catch((error) => {
            console.log(error);
          });
        },
        showEditMemo:function(memo){
          this.editMemo = "true";
          console.log(memo);
          this.memoTitle = memo.title;
          this.memoText = memo.text;
          this.memoId = memo.id;
          // this.$refs.editor.focus();
        },
        closeEditMemo:function(){
          this.editMemo = false;
        },
        updateMemo:function(){
          axios.patch('/api/memos/' + this.memoId, {title:this.memoTitle, text:this.memoText})
          .then((response) => {
              console.log(response);
              // memo.title = this.memoTitle;
              // memo.text = this.memoText;
          }).catch((error) => {
              console.log(error);
          });
          this.$router.go({path: '/calendar/memo', force: true});
        },
        showMemoRegister:function(){
          this.memoRegister = true;
          console.log(this.memoResister);
        },
        closeMemoRegister:function(){
          this.memoRegister = false;
        }
      },
      mounted: function() {
        // カテゴリデータを取得表示
        let self = this;
        axios.get('/api/memos')
        .then(function(response){
          self.memos = response.data;
        });
      }
    };
</script>