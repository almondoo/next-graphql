import { gql } from '@apollo/client';
import type { Task } from 'models/task';

export const CREATE_TASKS_QUERY = gql`
  query CreateTask($input: CreateTaskInput!) {
    createTask(input: $input) {
      id
      title
      text
    }
  }
`;

export interface TaskData {
  tasks: Task[];
}
